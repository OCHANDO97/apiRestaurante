<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleManagementController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// usuario
Route::post('login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout',[AuthController::class,'logout']);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('register',[AuthController::class,'register']);
        Route::post('createRole',[RoleManagementController::class,'createRole']);
        Route::post('asignaRole',[RoleManagementController::class,'asignaRole']);
    });

    // facturas
    Route::apiResource('factura/mesa/{mesa}', FacturaController::class)->only(['store']);
    Route::apiResource('factura', FacturaController::class);
    Route::post('factura/mesa/{mesa}/addProducto/{producto}', [FacturaController::class,'addProductoToFacturaOnMesa']);
    // categorias
    Route::apiResource('categorias', CategoriaController::class);
    // Producto
    Route::apiResource('productos', ProductoController::class);
    // mesas
    Route::apiResource('mesa', MesaController::class);


});






