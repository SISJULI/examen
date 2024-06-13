<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\LibroController;
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
    return view('welcome');
});
Route::resource('libreria/libros', LibroController::class);

Route::get('/biblioteca/libro', [LibroController::class, 'index'])->name('libro.index');
Route::get('/biblioteca/libro/create', [LibroController::class, 'create'])->name('libro.create');
Route::post('/biblioteca/libro/store', [LibroController::class, 'store'])->name('libro.store');
Route::get('/biblioteca/libro/{id}', [LibroController::class, 'show'])->name('libro.show');
Route::get('/biblioteca/libro/{id}/edit', [LibroController::class, 'edit'])->name('libro.edit');
Route::put('/biblioteca/libro/{id}', [LibroController::class, 'update'])->name('libro.update');
Route::delete('/biblioteca/libro/{id}', [LibroController::class, 'destroy'])->name('libro.destroy');