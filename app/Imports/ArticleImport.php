<?php

namespace App\Imports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Article::firstOrCreate([

            'depot' => $row['classification'],
            'famille' => $row['famille'],
            'code' => $row['code_article'],
            'designation' => $row['libelle_article'],
            'unite' => $row['code_unite_de_vente'],

        ]);
    }
}
