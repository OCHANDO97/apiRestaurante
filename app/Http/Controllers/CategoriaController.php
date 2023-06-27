<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    function showCategorias()  {

        return response()->json([
            'categorias' => Categoria::get()

        ]);
    }
}
