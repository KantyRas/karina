<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departements')->insert([
            ['nom' => 'Ressources Humaines', 'responsable' => 'Tsihorisoa Andrianjafinimanana'],
            ['nom' => 'Administration Finance', 'responsable' => 'Tiana Andrianarisoa'],
            ['nom' => 'Merchandising Sourcing Achats', 'responsable' => 'Sirajudeen Yousuf'],
            ['nom' => 'Planning', 'responsable' => 'Tahiana Rakotomalala'],
            ['nom' => 'Developpement Produit', 'responsable' => 'Tantely Randrianirina'],
            ['nom' => 'Qualite', 'responsable' => 'Arun Govind'],
            ['nom' => 'Compliance', 'responsable' => 'Aartee Jeebun'],
            ['nom' => 'Montage Services', 'responsable' => 'Vishal Soumber'],
            ['nom' => 'Valeur Ajoutée', 'responsable' => 'Sheila Soumber'],
            ['nom' => 'Finition', 'responsable' => 'Sheila Soumber'],
            ['nom' => 'Coupe', 'responsable' => 'Sheila Soumber'],
            ['nom' => 'Technologie Informatique', 'responsable' => 'Abel Randriamalala'],
            ['nom' => 'Visuel', 'responsable' => 'Sheila Soumber'],
            ['nom' => 'Transit', 'responsable' => 'Haingo Andrianarivo'],
            ['nom' => 'Maintenance', 'responsable' => 'Jean Cloud Mbelo Ndriamanampy'],
        ]);
    }
}
