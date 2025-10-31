<?php

namespace App\Imports;

use App\Models\Equipement;
use App\Models\Frequence;
use App\Models\ParametreEquipement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParametreEquipementImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $equipement = Equipement::where('nomequipement', trim($row['equipement']))->first();
        $frequence = Frequence::firstOrCreate([
            'frequence' => trim($row['frequence']),
        ]);
        if (!$equipement || !$frequence) {
            return null;
        }

        return new ParametreEquipement([
            'idequipement' => $equipement->idequipement,
            'nomparametre' => trim($row['parametre']),
            'idfrequence' => $frequence->idfrequence,
        ]);
    }
}
