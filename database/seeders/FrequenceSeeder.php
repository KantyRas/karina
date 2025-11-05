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
            ['frequence' => 'Journalier'],
            ['frequence' => 'Hebdomadaire'],
            ['frequence' => 'Mensuel'],
        ]);
    }
}
