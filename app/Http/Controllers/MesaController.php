<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mesa;

class MesaController extends Controller
{
    public function index(){
        $mesa = Mesa::all();
        return response()->json($mesa);
        }

    function show($id) {
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['mensaje' => 'Mesa no encontrada'], 404);
        }

        return response()->json($mesa);

    }


    public function update(Request $request, Mesa $mesa)
    {
        // Verificar si la mesa existe
        if (!$mesa) {
            return response()->json(['mensaje' => 'Mesa no encontrada'], 404);
        }
        $mesa->disponible = 0;
        $mesa->save();
    
        // Puedes opcionalmente retornar una respuesta o redireccionar a otra página
        return response()->json(['mensaje' => 'Registro actualizado con éxito']);
    }

}
