<?php

namespace App\Imports;

use App\Models\Equipement;
use App\Models\Frequence;
use App\Models\ParametreEquipement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class   ParametreEquipementImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        //$equipements = Equipement::where('nomequipement', trim($row['equipement']))->get();
        $equipements = Equipement::where('nomequipement', 'ilike', trim($row['equipement']) . '%')->get();
        $frequence = Frequence::firstOrCreate([
            'frequence' => trim($row['frequence']),
        ]);
        foreach ($equipements as $equipement) {
            ParametreEquipement::firstOrCreate([
                'idequipement' => $equipement->idequipement,
                'nomparametre' => trim($row['parametre']),
                'idfrequence' => $frequence->idfrequence,
            ]);
        }
        return null;
    }
}
