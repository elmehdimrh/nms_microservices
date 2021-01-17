<?php

namespace Database\Seeders;

use App\Models\Acteur;
use Illuminate\Database\Seeder;

class ActeursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Acteur::factory()->count(20)->create();
    }
}
