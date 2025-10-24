<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\maintenance\admin\EmployeController;
use App\Http\Controllers\maintenance\admin\FonctionController;
use App\Http\Controllers\maintenance\admin\RoleController;
use App\Http\Controllers\maintenance\admin\UserController;
use App\Http\Controllers\maintenance\carnet\CarnetController;
use App\Http\Controllers\maintenance\carnet\ReleveController;
use App\Http\Controllers\maintenance\demande\DemandeController;
use App\Http\Controllers\maintenance\gestion\DepotController;
use App\Http\Controllers\maintenance\gestion\EmplacementController;
use App\Http\Controllers\maintenance\gestion\FamilleController;
use App\Http\Controllers\maintenance\gestion\FrequenceController;
use App\Http\Controllers\maintenance\gestion\TypeDemandeController;
use App\Http\Controllers\maintenance\gestion\TypeInterventionController;
use App\Http\Controllers\maintenance\gestion\UniteController;
use App\Http\Controllers\maintenance\ImportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('maintenance.login');
})->name('login');

Route::post('/loginAction',[AuthController::class,'loginAction'])->name('login.auth');
Route::get('/logout',[AuthController::class,'logout'])->name('logout.auth');

Route::middleware(['auth', 'role:1,2,4'])->group(function () {
    Route::get('/home',[DashController::class, 'Dashboard'])->name('index.dashboard');

    Route::prefix('admin')->name('admin.personnel.')->group(function(){
        Route::resource('employe',EmployeController::class)->except(['show']);
        Route::resource('role',RoleController::class)->except(['show']);
        Route::resource('user',UserController::class)->except(['show']);
        Route::resource('fonction',FonctionController::class)->except(['show']);
    });

    Route::prefix('gestions')->name('util.gestion.')->group(function(){
        Route::resource('emplacement',EmplacementController::class)->except(['show']);
        Route::resource('frequence',FrequenceController::class)->except(['show']);
        Route::resource('depot',DepotController::class)->except(['show']);
        Route::resource('famille', FamilleController::class)->except(['show']);
        Route::resource('unite', UniteController::class)->except(['show']);
        Route::resource('typedemandy',TypeDemandeController::class)->except(['show']);
        Route::resource('typeintervention',TypeInterventionController::class)->except(['show']);
    });

    Route::prefix('carnets')->name('carnet.')->group(function () {
        Route::get('/',[CarnetController::class,'index'])->name('liste_carnet');
        Route::get('/create',[CarnetController::class,'create'])->name('create_carnet');
        Route::post('/store',[CarnetController::class,'store'])->name('store');
        Route::get('/fiche/historique/{id}',[CarnetController::class,'showHistorique'])->name('fiche_carnet_historique');
        Route::get('/fiche/saisie/{idhistoriqueequipement}',[CarnetController::class,'getDetailEquipement'])->name('fiche_saisie');
        Route::get('/releves',[ReleveController::class,'index'])->name('liste_releve');
        Route::get('/releve/historique/{idtypereleve}',[ReleveController::class,'get_releve_historique'])->name('historique_releve');
        Route::get('/releve/historique/details/{idhistoriquereleve}',[ReleveController::class,'get_releve_historique_detail'])->name('detail_historique_releve');
        Route::get('/releve/ajout',[ReleveController::class,'get_form_ajout_type_releve'])->name('ajout_releve');
        Route::post('/releve/store_detail/{idhistoriquereleve}',[ReleveController::class,'ajout_detatil_releve'])->name('store_detail_releve');
        Route::post('/releve/store',[ReleveController::class,'ajout_type_releve'])->name('store_type_releve');
        Route::post('/releve/generer/{idtypereleve}',[ReleveController::class,'genererHistorique'])->name('generate_historique_releve');
        Route::get('/releve/exportpdf/{idhistoriquereleve}',[ReleveController::class,'exportPdfReleveMensuel'])->name('releve_exportpdf');
        Route::post('/carnet/generer/{id}',[CarnetController::class,'genererHistorique'])->name('generate_historique_equipement');
        Route::post('/carnet/ajoutDetail',[CarnetController::class,'insertDetail'])->name('ajout_detail_equipement');
    });

    Route::prefix('demandes')->group(function(){
        Route::resource('demande', DemandeController::class)->except(['show']);
        Route::get('/details/{iddemandeachat}',[DemandeController::class,'get_detail_achat'])->name('demande.detail');
        Route::get('/details/pdf/{iddemandeachat}',[DemandeController::class,'exportPdf'])->name('demande.exportPdf');
        Route::get('/travaux',[DemandeController::class,'index_travaux'])->name('demande.liste_demande_travaux');
        Route::get('/travaux/ajout',[DemandeController::class,'ajout_travaux'])->name('demande.form_demande_travaux');
        Route::post('/travaux/store',[DemandeController::class,'storeTravaux'])->name('demande.store_travaux');
        Route::get('/travaux/details/{iddemandetravaux}',[DemandeController::class,'get_detail_travaux'])->name('demande.detail_demande_travaux');
        Route::get('/get_responsable/{iddepartement}', [DemandeController::class,'getResponsable'])->name('demande.getResponsable');
        Route::get('/travaux/details/validation/{iddemandetravaux}', [DemandeController::class,'updateValider'])->name('demande.valider');
        Route::get('/travaux/details/refus/{iddemandetravaux}', [DemandeController::class,'refuserdemande'])->name('demande.refuser');
        Route::get('/notifications/reads', [DemandeController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
        Route::get('/',[InterventionController::class,'index'])->name('demande.intervention.liste_intervention');
        Route::get('/create',[InterventionController::class,'create'])->name('demande.intervention.create_intervention');
    });


    Route::prefix('articles')->group(function(){
        Route::resource('article', ArticleController::class)->except(['show']);
        Route::post('/importAction', [ImportController::class,'importAction'])->name('importAction');
    });
});
