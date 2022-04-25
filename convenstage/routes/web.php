<?php

use App\Http\Controllers\UserController;
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
    return view('index');
});

Route::get('/dashboard', function () {
    return view('board');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



// Route pour les admins
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Route pour les users



// Route pour les profs



// Route de Test
Route::get('/foo', '\App\Http\Controllers\TestController@foo');
Route::get('/bar', '\App\Http\Controllers\TestController@bar');

