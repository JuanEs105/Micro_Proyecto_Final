<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\RetroItemController;

// Rutas para Sprints (incluye index, create, store, show, edit, update si lo deseas)
Route::resource('sprints', SprintController::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update'
]);

// Rutas anidadas para RetroItems dentro de un Sprint
Route::prefix('sprints/{sprint}')->group(function () {
    Route::get('retro-items/create', [RetroItemController::class, 'create'])->name('sprints.retro-items.create');
    Route::post('retro-items', [RetroItemController::class, 'store'])->name('sprints.retro-items.store');
});

// Ruta para eliminar un ítem de retro individual (fuera del sprint)
Route::delete('/retro-items/{retroItem}', [RetroItemController::class, 'destroy'])->name('retro-items.destroy');

// Mostrar formulario para editar un ítem
Route::get('/retro-items/{retroItem}/edit', [RetroItemController::class, 'edit'])
     ->name('retro-items.edit');

// Actualizar un ítem existente
Route::put('/retro-items/{retroItem}', [RetroItemController::class, 'update'])
     ->name('retro-items.update');

     
Route::post('/sprints/{sprint}/importar-acciones', [RetroItemController::class, 'importarAcciones'])->name('retro-items.importar');
