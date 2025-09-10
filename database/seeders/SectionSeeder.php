<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->insert([
            ['iddepartement' => 1, 'nomsection' => 'Personnel'],
            ['iddepartement' => 1, 'nomsection' => 'Femmes de menage'],
            ['iddepartement' => 1, 'nomsection' => 'Securite'],
            ['iddepartement' => 1, 'nomsection' => 'Transport'],

            ['iddepartement' => 2, 'nomsection' => 'Comptabilite'],
            ['iddepartement' => 2, 'nomsection' => 'Controleur de Gestion'],
            ['iddepartement' => 2, 'nomsection' => 'Grand Magasin Accessoires'],
            ['iddepartement' => 2, 'nomsection' => 'Grand Magasin Tissu'],
            ['iddepartement' => 2, 'nomsection' => 'Achat Fournitures Consommables'],

            ['iddepartement' => 3, 'nomsection' => 'Merchandising'],
            ['iddepartement' => 3, 'nomsection' => 'Achats Tissus'],
            ['iddepartement' => 3, 'nomsection' => 'Achats Accessoires Production'],

            ['iddepartement' => 4, 'nomsection' => 'Sec_Planning'],
            ['iddepartement' => 4, 'nomsection' => 'Qmo'],
            ['iddepartement' => 4, 'nomsection' => 'Seam'],

            ['iddepartement' => 5, 'nomsection' => 'Patronage'],
            ['iddepartement' => 5, 'nomsection' => 'Echantillonage'],

            ['iddepartement' => 6, 'nomsection' => 'Laboratoires'],
            ['iddepartement' => 6, 'nomsection' => 'Controle Tissus'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite Echantillonnage'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite pre-production'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite coupe thermo biais'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite valeus ajoutees'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite confection montage'],
            ['iddepartement' => 6, 'nomsection' => 'Inspection avant apres Lavage'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite lavage teinture'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite finition mise en carton'],
            ['iddepartement' => 6, 'nomsection' => 'Assurance qualite montage'],
            ['iddepartement' => 6, 'nomsection' => 'Assurance qualite finition'],
            ['iddepartement' => 6, 'nomsection' => 'Assurance qualite finale'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite 1er_choix 2nd_choix'],
            ['iddepartement' => 6, 'nomsection' => 'Qualite sous-traitance'],

            ['iddepartement' => 7, 'nomsection' => 'Audit interne'],
            ['iddepartement' => 7, 'nomsection' => 'Sec_compliance'],

            ['iddepartement' => 8, 'nomsection' => 'Packing'],
            ['iddepartement' => 8, 'nomsection' => 'Montage'],
            ['iddepartement' => 8, 'nomsection' => 'Temps Méthodes'],
            ['iddepartement' => 8, 'nomsection' => 'Pré-production'],
            ['iddepartement' => 8, 'nomsection' => 'Mécanique'],

            ['iddepartement' => 9, 'nomsection' => 'Sérigraphie'],
            ['iddepartement' => 9, 'nomsection' => 'Broderie machine'],
            ['iddepartement' => 9, 'nomsection' => 'Broderie main'],

            ['iddepartement' => 10, 'nomsection' => 'Transfert'],
            ['iddepartement' => 10, 'nomsection' => 'Lavage'],
            ['iddepartement' => 10, 'nomsection' => 'Finition'],
            ['iddepartement' => 10, 'nomsection' => 'Produits finis'],
            ['iddepartement' => 10, 'nomsection' => 'Mise en carton'],

            ['iddepartement' => 11, 'nomsection' => 'Smocks'],
            ['iddepartement' => 11, 'nomsection' => 'Biais'],
            ['iddepartement' => 11, 'nomsection' => 'Coupe'],
            ['iddepartement' => 11, 'nomsection' => 'Thermocollage'],
            ['iddepartement' => 11, 'nomsection' => 'Préparation après coupe'],
            ['iddepartement' => 11, 'nomsection' => 'Magasin coupe'],

            ['iddepartement' => 12, 'nomsection' => 'Technologie informatique'],
            ['iddepartement' => 13, 'nomsection' => 'Visuel'],
            ['iddepartement' => 14, 'nomsection' => 'Transit'],
            ['iddepartement' => 15, 'nomsection' => 'Maintenance'],
        ]);
    }
}
