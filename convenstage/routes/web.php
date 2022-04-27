<?php

use App\Http\Controllers\SuivisController;
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
});
Route::view('/home', 'home')->middleware('auth')->name('home');

// Route pour gérer les utilisateurs
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
Route::post('/users/{id}', [UsersController::class, 'update'])->name('users.update');

// Route pour les suivis
Route::get('/suivis', [SuivisController::class, 'index'])->name('suivis');
Route::get('/suivis/{id}', [SuivisController::class, 'show'])->name('suivis.show');
