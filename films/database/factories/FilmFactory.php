<?php


namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->sentence(2),
            'annee' => $this->faker->year(),
            'acteurs' => $this->filmActorsFromAPI()
        ];
    }

    private function filmActorsFromAPI()
    {
        $random = range(1,20);

        shuffle($random);
        $ids =  array_rand($random,random_int(1,3));
        $uri = config('films.ACTORS_API');

        $actors = collect($ids)->map(function ($item) use ($uri,$random) {
            $response = Http::get($uri . '/read/' . $random[$item]);

            if($response->successful()) {
                $content = $response->json();
                return array('id' => $content['id'],'nom'=>$content['nom']);
            }

        })->toArray();

        return serialize($actors);
    }

}
