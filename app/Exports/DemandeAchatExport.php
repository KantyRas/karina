<?php

namespace App\Exports;

use App\Models\DemandeAchat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DemandeAchatExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $iddemandeachat;

    public function __construct($iddemandeachat)
    {
        $this->iddemandeachat = $iddemandeachat;
    }

    public function collection()
    {
        return DemandeAchat::with(['demandeur', 'detailArticles.article'])
            ->where('iddemandeachat', $this->iddemandeachat)
            ->get();
    }

    public function headings(): array
    {
        return [
            'num_demande',
            'demandeur',
            'date_demande',
            'code_article',
            'designation',
            'quantité_demandee',
            'unite',
        ];
    }

    public function map($demande): array
    {
        $rows = [];

        foreach ($demande->detailArticles as $article) {
            $rows[] = [
                'Achat/n°' . str_pad($demande->iddemandeachat, 4, '0', STR_PAD_LEFT),
                $demande->demandeur->username ?? '-',
                optional($demande->datedemande)->format('d/m/Y'),
                $article->article->code ?? '-',
                $article->article->designation ?? '-',
                $article->quantitedemande ?? '',
                $article->article->unite ?? '-',
            ];
        }

        return $rows;
    }

    public function title(): string
    {
        return 'Demande Achat ' . str_pad($this->iddemandeachat, 4, '0', STR_PAD_LEFT);
    }
}
