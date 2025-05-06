<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;
use App\Http\Controllers\ReservasController;

// Listagem dos quartos
Route::get('/', [QuartosController::class, 'index'])->name('quartos.index');

// Formulário de criação de quarto
Route::get('/create', [QuartosController::class, 'create'])->name('quartos.create');

// Enviar dados do formulário de criação de quarto
Route::post('/store', [QuartosController::class, 'store'])->name('quartos.store');

// Formulário de edição de quarto
Route::get('/edit/{id}', [QuartosController::class, 'edit'])->name('quartos.edit');

// Enviar dados do formulário de edição de quarto
Route::put('/update/{id}', [QuartosController::class, 'update'])->name('quartos.update');

// Deletar quarto
Route::delete('/delete/{id}', [QuartosController::class, 'destroy'])->name('quartos.destroy');


// Rotas para Reservas
Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');
Route::get('/reservas/create', [ReservasController::class, 'create'])->name('reservas.create');
Route::post('/reservas/store', [ReservasController::class, 'store'])->name('reservas.store');
Route::get('/reservas/edit/{id}', [ReservasController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/update/{id}', [ReservasController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/delete/{id}', [ReservasController::class, 'destroy'])->name('reservas.destroy');
