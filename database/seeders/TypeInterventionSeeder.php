<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeInterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_interventions')->insert([
            ['type' => 'Urgent'],
            ['type' => 'Non urgent'],
            ['type' => 'Autres'],
        ]);
    }
}
