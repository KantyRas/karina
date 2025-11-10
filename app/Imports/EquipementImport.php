<?php

namespace App\Imports;

use App\Models\Emplacement;
use App\Models\Employe;
use App\Models\EmployeEquipement;
use App\Models\Equipement;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquipementImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
//        $equipementNom = Str::of($row['equipement'])->trim();
//        $emplacementNom = Str::of($row['emplacement'])->trim();
//
//        $emplacement = Emplacement::firstOrCreate(
//            ['emplacement' => $emplacementNom]
//        );
//
//        $existing = Equipement::whereRaw('unaccent(lower(nomequipement)) = unaccent(lower(?))', [$equipementNom])
//            ->first();
//
//        if (!$existing) {
//            $equipement = Equipement::create([
//                'nomequipement' => $equipementNom,
//                'idemplacement' => $emplacement->idemplacement,
//            ]);
//        } else {
//            $equipement = $existing;
//        }
//
//        foreach (['employe1', 'employe2'] as $col) {
//            if (!empty($row[$col])) {
//                $employe = Employe::where('matricule', trim($row[$col]))->first();
//
//                if ($employe) {
//                    EmployeEquipement::firstOrCreate([
//                        'idemploye' => $employe->idemploye,
//                        'idequipement' => $equipement->idequipement,
//                    ]);
//                }
//            }
//        }
//        return null;
        // Récupération et nettoyage des données Excel
        $equipementNom = Str::of($row['equipement'])->trim();
        $emplacementNom = Str::of($row['emplacement'])->trim();
        $nombreTotal = isset($row['nombre_total']) && is_numeric($row['nombre_total'])
            ? (int)$row['nombre_total']
            : 1; // Par défaut 1 si non renseigné

        // Création ou récupération de l’emplacement
        $emplacement = Emplacement::firstOrCreate(
            ['emplacement' => $emplacementNom]
        );

        // Vérifie si cet équipement existe déjà
        $existing = Equipement::whereRaw('unaccent(lower(nomequipement)) = unaccent(lower(?))', [$equipementNom])
            ->where('idemplacement', $emplacement->idemplacement)
            ->first();

        // Crée l’équipement si inexistant
        if (!$existing) {
            $equipement = Equipement::create([
                'nomequipement' => $equipementNom,
                'idemplacement' => $emplacement->idemplacement,
            ]);
        } else {
            $equipement = $existing;
        }

        // Boucle selon le nombre total demandé
        for ($i = 1; $i <= $nombreTotal; $i++) {

            // Si tu veux un nom unique pour chaque exemplaire, on ajoute un suffixe
            $nomComplet = $nombreTotal > 1
                ? $equipementNom.'-'.$emplacementNom . ' ' .'nº'.$i
                : $equipementNom;

            $equipementCopie = Equipement::firstOrCreate([
                'nomequipement' => $nomComplet,
                'idemplacement' => $emplacement->idemplacement,
            ]);

            // Attribution des employés (employe1 / employe2)
            foreach (['employe1', 'employe2'] as $col) {
                if (!empty($row[$col])) {
                    $employe = Employe::where('matricule', trim($row[$col]))->first();

                    if ($employe) {
                        EmployeEquipement::firstOrCreate([
                            'idemploye' => $employe->idemploye,
                            'idequipement' => $equipementCopie->idequipement,
                        ]);
                    }
                }
            }
        }

        return null;
    }
}
