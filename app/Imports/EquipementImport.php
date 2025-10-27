<?php

namespace App\Imports;

use App\Models\Emplacement;
use App\Models\Equipement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquipementImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $emplacement = Emplacement::firstOrCreate([
            'emplacement' => $row['emplacement'],
        ]);

        return new Equipement([
            'nomequipement' => $row['nomequipement'],
            'code' => $row['code'],
            'idemplacement' => $emplacement->idemplacement,
        ]);
    }
}
