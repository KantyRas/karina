<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_demandes')->insert([
            ['nomtype' => 'Maintenance generale', 'id_receveur' => 1],
            ['nomtype' => 'Informatique', 'id_receveur' => 1],
        ]);
    }
}
