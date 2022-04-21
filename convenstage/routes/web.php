<?php

use App\Http\Controllers\RolesController;
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

// Route présentes par défaut dans l'application
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



// Route pour les admins
Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
Route::post('/roles/', [RolesController::class, 'show'])->name('roles.show');


// Route pour les users



// Route pour les profs



// Route de Test
Route::get('/foo', '\App\Http\Controllers\TestController@foo');
Route::get('/bar', '\App\Http\Controllers\TestController@bar');

