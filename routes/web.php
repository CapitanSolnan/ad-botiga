<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministrarController;
use App\Http\Controllers\CarritoController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('producte/administrar', AdministrarController::class)
    ->middleware('auth')
    ->names('producte.administrar');

Route::resource('producte', ProductesController::class)
    ->names('producte');

Route::get('/producte', [ProductesController::class, 'index'])->name('producte');

Route::resource('carrito', CarritoController::class)
    ->middleware('auth');

Route::get('/carrito', [CarritoController::class, 'index'])
    ->middleware('auth');

Route::get('/carrito/comprar', [CarritoController::class, 'comprar'])
    ->middleware('auth')
    ->name('carrito.comprar');
