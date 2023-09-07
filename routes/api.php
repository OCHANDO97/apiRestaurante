<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleManagementController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// usuario
Route::post('login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('register',[AuthController::class,'register']);
        Route::post('createRole',[RoleManagementController::class,'createRole']);
        Route::post('asignaRole',[RoleManagementController::class,'asignaRole']);

    });

    Route::get('logout',[AuthController::class,'logout']);

    // facturas
    Route::controller(FacturaController::class)->group(function () {
        Route::get('showFacturas', 'showFacturas');
        Route::get('buscarFactura/{id}','buscarFactura');
        Route::post('addFacturaMesa','addFacturaMesa');
        Route::post('addProductoMesa','addProductoMesa');
    });

    // categorias
    Route::get('showCategorias',[CategoriaController::class,'showCategorias']);
    // Producto
    Route::get('listarProductoCategorias/{id}',[ProductoController::class,'showCarta']);

    // mesas
    Route::controller(MesaController::class)->group(function () {
        Route::get('showMesas','showMesas');
        Route::get('showDisponibilidad','showDisponibilidad');
        Route::put('editarDisponibilidad/{id}','editarDisponibilidad');
    });

});






