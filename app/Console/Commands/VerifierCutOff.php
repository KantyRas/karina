<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\maintenance\carnet\CarnetController;

class VerifierCutOff extends Command
{

    protected $signature = 'app:verifier-cut-off {idfrequence?}';
    protected $description = 'Command description';

    public function handle()
    {
        // Exemple : appel d’une méthode d’un contrôleur ou d’un service
        $idfrequence = $this->argument('idfrequence'); // Récupère la valeur passée
        $ctrl = new CarnetController();
        $ctrl->verifiercutoff($idfrequence);

        \Log::info('✅ La commande verifier() a bien été exécutée à ' . now());
        $this->info('Vérification exécutée avec succès.');
    }
}
