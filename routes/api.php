<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// usuarios
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/logout',[AuthController::class,'logout']);

});

// facturas
Route::get('/showFacturas',[FacturaController::class,'showFacturas']);
Route::get('/buscarFactura/{id}',[FacturaController::class,'buscarFactura']);
Route::post('/addFacturaMesa',[FacturaController::class,'addFacturaMesa']);
Route::post('/addProductoMesa',[FacturaController::class,'addProductoMesa']);


// categorias
Route::get('/showCategorias',[CategoriaController::class,'showCategorias']);
// Producto
Route::get('/listarProductoCategorias/{id}',[ProductoController::class,'showCarta']);
// mesas
Route::get('/showMesas',[MesaController::class,'showMesas']);
Route::get('/showDisponibilidad',[MesaController::class,'showDisponibilidad']);
Route::put('/editaDisponibilidad/{id}',[MesaController::class,'editarDisponibilidad']);


