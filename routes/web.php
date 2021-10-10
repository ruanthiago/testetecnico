<?php

use App\Http\Controllers\CarroController;
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

/* Redireciona */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('carros');
})->name('dashboard');

/* Rotas relacionados ao controller: Carro */
Route::middleware(['auth:sanctum', 'verified'])->get('/carros', [CarroController::class, 'index'])->name('carros');
Route::middleware(['auth:sanctum', 'verified'])->post('/carros/capturar', [CarroController::class, 'capturar'])->name('carros-capturar');
Route::middleware(['auth:sanctum', 'verified'])->delete('/carros/{id}/delete', [CarroController::class, 'delete'])->name('carros-delete');
