<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetEquipementImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Equipements' => new \App\Imports\EquipementImport(),
            'parametre_equipement' => new \App\Imports\ParametreEquipementImport(),
        ];
    }
}
