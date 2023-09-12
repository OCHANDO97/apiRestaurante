<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    function show($id) {

        return response()->json(Producto::where('idCategoria', $id)->get());
        }
}
