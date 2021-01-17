<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('microservices')->insert([
            ['nom' => 'acteurs','base_url' => 'http://localhost:8000','token' => base64_encode('actors:20nomalis21')],
            ['nom' => 'films','base_url' => 'http://localhost:9000','token' => base64_encode('movies:20nomalis21')],
            ['nom' => 'gateway','base_url' => 'http://localhost:7000','token' => base64_encode('gateway:20nomalis21')]
        ]);
    }
}
