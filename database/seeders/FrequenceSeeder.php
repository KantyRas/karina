<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequences')->insert([
            ['frequence' => 'JOURNALIER'],
            ['frequence' => 'HEBDOMADAIRE'],
            ['frequence' => 'MENSUEL'],
            ['frequence' => 'ANNUEL'],
            ['frequence' => 'TRIMESTRIEL'],
            ['frequence' => 'SEMESTRIEL'],
        ]);
    }
}
