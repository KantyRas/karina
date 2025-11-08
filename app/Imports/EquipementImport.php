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
        $equipementNom = Str::of($row['equipement'])->trim();
        $emplacementNom = Str::of($row['emplacement'])->trim();

        $emplacement = Emplacement::firstOrCreate(
            ['emplacement' => $emplacementNom]
        );

        $existing = Equipement::whereRaw('unaccent(lower(nomequipement)) = unaccent(lower(?))', [$equipementNom])
            ->first();

        if (!$existing) {
            $equipement = Equipement::create([
                'nomequipement' => $equipementNom,
                'idemplacement' => $emplacement->idemplacement,
            ]);
        } else {
            $equipement = $existing;
        }

        foreach (['employe1', 'employe2'] as $col) {
            if (!empty($row[$col])) {
                $employe = Employe::where('matricule', trim($row[$col]))->first();

                if ($employe) {
                    EmployeEquipement::firstOrCreate([
                        'idemploye' => $employe->idemploye,
                        'idequipement' => $equipement->idequipement,
                    ]);
                }
            }
        }
        return null;
    }
}
