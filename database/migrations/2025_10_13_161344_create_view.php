<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // --- Vue 1 : v_liste_equipement ---
        DB::statement("
            CREATE VIEW v_liste_equipement AS
            SELECT
                eq.idequipement,
                eq.nomequipement,
                eq.code,
                ep.idemplacement,
                ep.emplacement,
                e.idemploye,
                emp.nom AS nomemploye,
                emp.prenom,
                emp.matricule
            FROM equipements eq
            JOIN employe_equipements e ON e.idequipement = eq.idequipement
            JOIN employes emp ON emp.idemploye = e.idemploye
            JOIN emplacements ep ON eq.idemplacement = ep.idemplacement;
        ");

        // --- Vue 2 : v_liste_equipement_regroupe ---
        DB::statement("
            CREATE VIEW v_liste_equipement_regroupe AS
            SELECT
                idequipement,
                nomequipement,
                code,
                idemplacement,
                emplacement,
                STRING_AGG(nomemploye || ' ' || prenom, ' - ' ORDER BY nomemploye, prenom) AS nomemploye,
                STRING_AGG(matricule, ' - ' ORDER BY matricule) AS matricule
            FROM v_liste_equipement
            GROUP BY idequipement, nomequipement, code, idemplacement, emplacement;
        ");

        // --- Vue 3 : v_detail_equipement ---
        DB::statement("
            CREATE VIEW v_detail_equipement AS
            SELECT
                ped.id,
                ped.idparametreequipement,
                ped.valeur,
                ped.dateajout,
                ped.idhistoriqueequipement,
                pe.idequipement,
                pe.nomparametre,
                f.idfrequence,
                f.frequence
            FROM parametre_equipement_details ped
            JOIN parametre_equipements pe ON ped.idparametreequipement = pe.idparametreequipement
            JOIN frequences f ON pe.idfrequence = f.idfrequence;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_liste_equipement;');
        DB::statement('DROP VIEW IF EXISTS v_liste_equipement_regroupe;');
        DB::statement('DROP VIEW IF EXISTS v_detail_equipement;');
    }
};
