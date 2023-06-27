<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;

class MesaController extends Controller
{
    public function showMesas(){
        $mesa = Mesa::all();
        return response()->json($mesa);
        }

    function showDisponibilidad() {
        return response()->json(Mesa::where('disponible', 0)->get());
            
    }

    public function editarDisponibilidad(Request $request, $id){

        // Buscar el registro existente en la base de datos por su ID
        $registro = Mesa::find($id);

        // Verificar si el registro existe
        if (!$registro) {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }

        // Actualizar los valores del registro con los datos del formulario
        $registro->disponible = $request->input("disponible");
        // Actualizar otras propiedades del registro según tus necesidades
        // Guardar los cambios en la base de datos
        $registro->save();

        // Opcionalmente, puedes retornar una respuesta o redireccionar a otra página
        return response()->json(['mensaje' => 'Registro actualizado con éxito']);
    }



}
