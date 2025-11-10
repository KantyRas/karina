<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Employe::with('fonction')->get();
    }

    public function headings(): array
    {
        return [
            'matricule',
            'nom',
            'prenom',
            'fonction',
            'email',
            'telephone',
        ];
    }

    public function map($employe): array
    {
        return [
            $employe->matricule,
            $employe->nom,
            $employe->prenom,
            $employe->fonction->fonction ?? '-',
            $employe->email ?? '-',
            $employe->telephone ?? '-',
        ];
    }
}
