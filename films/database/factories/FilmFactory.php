<?php


namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

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
        $actors_ms = DB::table('microservices')->where('nom','acteurs')->select('base_url','token')->first();
        return [
            'nom' => $this->faker->sentence(2),
            'annee' => $this->faker->year(),
            'acteurs' => $this->filmActorsFromAPI($actors_ms)
        ];
    }

    private function filmActorsFromAPI($actors_ms)
    {
        $random = range(1,20);

        shuffle($random);
        $ids =  array_rand($random,random_int(1,3));

        $actors = collect($ids)->map(function ($item) use ($random,$actors_ms) {

            $response = Http::withToken($actors_ms->token)->get($actors_ms->base_url . '/actor/read/' . $random[$item]);

            if($response->successful()) {
                $content = $response->json();
                return array('id' => $content['id'],'nom'=>$content['nom']);
            }

        })->toArray();

        return serialize($actors);
    }

}
