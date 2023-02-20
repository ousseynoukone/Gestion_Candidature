<?php
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\FormationCandidatController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\JsController;
use App\Http\Controllers\ReferentielController;
use App\Http\Controllers\TypeController;
use App\Models\Candidat;
use App\Models\Formation;
use App\Models\FormationCandidat;
use App\Models\Referentiel;
use App\Models\Type;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('formations/update/{id}', [FormationController::class, 'updateStart']);
Route::get('referentiels/update/{id}', [ReferentielController::class, 'updateValidated']);
Route::get('jscontroller', [JsController::class, 'index']);
Route::get('jscontroller/{id}/{user_id}', [JsController::class, 'update']);



Route::resource('candidats',CandidatController::class);
Route::resource('formations',FormationController::class);
Route::resource('referentiels',ReferentielController::class);
Route::resource('types',TypeController::class);
Route::resource('fcs',FormationCandidatController::class);
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('fcs.index');
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


