<?php

use App\Http\Controllers\AnotacionController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\ColeccionController;
use App\Http\Controllers\EdicionController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\IdeologiaController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\SagaController;
use App\Http\Controllers\UsuarioEdicionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuario', [AuthController::class, 'me']);

    Route::apiResource('autores', AutorController::class);
    Route::apiResource('obras', ObraController::class);
    Route::apiResource('ediciones', EdicionController::class);
    Route::apiResource('editoriales', EditorialController::class);
    Route::apiResource('colecciones', ColeccionController::class);
    Route::apiResource('generos', GeneroController::class);
    Route::apiResource('ideologias', IdeologiaController::class);
    Route::apiResource('sagas', SagaController::class);
    Route::apiResource('etiquetas', EtiquetaController::class);
    Route::apiResource('anotaciones', AnotacionController::class);
    Route::apiResource('usuario-ediciones', UsuarioEdicionController::class);
});
