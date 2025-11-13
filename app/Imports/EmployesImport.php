<?php

namespace App\Imports;

use App\Models\Employe;
use App\Models\Fonction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fonctions = Fonction::firstOrCreate([
            'fonction' => trim($row['fonction']),
        ]);
        return Employe::firstOrCreate([
            'matricule' => $row['matricule'],
            'nom' => $row['nom'],
            'prenom' => trim($row['prenom']),
            'idfonction' => $fonctions->idfonction ?? null,
            'email' => $row['email'],
            'telephone' => $row['telephone'],
        ]);
    }
}
