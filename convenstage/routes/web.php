<?php

use App\Http\Controllers\ConventionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SuivisController;
use App\Http\Controllers\TachesController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::view('/profil', 'profil')->middleware('auth', 'verified')->name('home');

// Route pour la redirection en fonction de la connexion ou inscription
Route::get('/redirect', [HomeController::class, 'index'])->name('redirect');

// Route pour gérer les utilisateurs
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/{user_id}', [UsersController::class, 'show'])->name('users.show');
Route::post('/users', [UsersController::class, 'update'])->name('users.update');
Route::get('/users-search', [UsersController::class, 'search'])->name('users.search');
Route::get('/users-eleve-search', [UsersController::class, 'eleveSearch'])->name('users.eleveSearch');

// Route pour les suivis
Route::get('/suivis', [SuivisController::class, 'index'])->name('suivis');
Route::get('/suivis/{id}', [SuivisController::class, 'show'])->name('suivis.show');
Route::get('suivis-create', [SuivisController::class, 'create'])->name('suivis.create');
Route::post('/suivis', [SuivisController::class, 'store'])->name('suivis.store');
Route::delete('/suivis/{id}', [SuivisController::class, 'destroy'])->name('suivis.destroy');
Route::get('/suivis-search', [SuivisController::class, 'search'])->name('suivis.search');
Route::get('/suivis-tuteur-search', [SuivisController::class, 'tuteurSearch'])->name('suivis.tuteurSearch');

// Route pour les taches
Route::get('/suivis/{id}/taches', [TachesController::class, 'index'])->name('taches');
Route::get('/suivis/{id}/taches/{tache_id}', [TachesController::class, 'show'])->name('taches.show');
Route::get('/suivis/{id}/taches-create', [TachesController::class, 'create'])->name('taches.create');
Route::post('/suivis/{id}/taches', [TachesController::class, 'store'])->name('taches.store');
Route::delete('/suivis/{id}/taches/{tache_id}-destroy', [TachesController::class, 'destroyBis'])->name('taches.destroyBis');
Route::delete('/suivis/{id}/taches/{tache_id}', [TachesController::class, 'destroy'])->name('taches.destroy');
Route::post('/suivis/{id}/taches/{tache_id}', [TachesController::class, 'updateEtat'])->name('taches.validate');
Route::get('/suivis/{id}/taches/{tache_id}/edit', [TachesController::class, 'edit'])->name('taches.edit');
Route::put('/suivis/{id}/taches/{tache_id}-e', [TachesController::class, 'update'])->name('taches.update');

// Route pour les conventions
Route::get('/suivis/{id}/conventions', [ConventionsController::class, 'index'])->name('conventions');
Route::get('/suivis/{id}/conventions-create', [ConventionsController::class, 'create'])->name('conventions.create');
Route::post('/suivis/{id}/taches/{tache_id}/upload', [ConventionsController::class, 'store'])->name('conventions.store');
Route::delete('/suivis/{id}/conventions', [ConventionsController::class, 'destroy'])->name('conventions.destroy');

// Route pour les mails
Route::post('/suivis/{id}/taches-mails', [MailController::class, 'sendMail'])->name('mails.send');
