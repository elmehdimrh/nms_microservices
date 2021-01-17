<?php

namespace Database\Factories;

use App\Models\Acteur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActeurFactory extends Factory
{

    protected $model = Acteur::class;


    public function definition()
    {
        return [
            'nom' => $this->faker->name,
        ];
    }
}
