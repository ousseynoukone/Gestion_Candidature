<?php

use App\Http\Controllers\CandidatController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ReferentielController;
use App\Http\Controllers\TypeController;
use App\Models\Candidat;
use App\Models\Formation;
use App\Models\Referentiel;
use App\Models\Type;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/basic', function () {
    return view('basic');
});


Route::get('/', function () {
    return view('Accueil.index');
})->name('accueil');








Route::resource('candidats',CandidatController::class);
Route::resource('formations',FormationController::class);
Route::resource('referentiels',ReferentielController::class);
Route::resource('types',TypeController::class);
