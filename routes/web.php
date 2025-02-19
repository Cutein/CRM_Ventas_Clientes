<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Clientes;
use App\livewire\Productos;
use App\livewire\Ventas;
use App\livewire\VentasRealizadas;
use App\Http\Controllers\DashboardController;

Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/clientes', Clientes::class)->middleware('auth')->name('clientes');
Route::get('/productos', Productos::class)->middleware('auth')->name('productos');
Route::get('/ventas', Ventas::class)->middleware('auth')->name('ventas');
Route::get('/ventas-realizadas', VentasRealizadas::class)->name('ventas.realizadas');

require __DIR__.'/auth.php';
