<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTravauxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_travaux')->insert([
            ['type' => 'REPARATION', 'duree' => 10],
            ['type' => 'RENNOVATION', 'duree' => 15],
            ['type' => 'CONFECTION', 'duree' => 7],
        ]);
    }
}
