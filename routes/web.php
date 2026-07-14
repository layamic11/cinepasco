<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DulceriaController; // 1. Importa el controlador de dulcería si ya lo tienes

// Ruta principal que carga el diseño
Route::get('/', [PeliculaController::class, 'index']);

// Rutas de seguridad
Route::post('/iniciar-sesion', [AuthController::class, 'login']);
Route::post('/registro', [AuthController::class, 'register']);
Route::get('/probar-singleton', [CarritoController::class, 'probarPatron']);

// Esto crea automáticamente las 7 rutas estándar de Laravel para cada acción (create, store, edit, update, destroy, etc.)
Route::resource('peliculas', PeliculaController::class);
Route::resource('dulceria', DulceriaController::class);


