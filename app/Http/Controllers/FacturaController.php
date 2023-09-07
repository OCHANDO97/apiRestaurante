<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Mesa;

use Carbon\Carbon;
class FacturaController extends Controller
{
    public function showFacturas()
    {

        $facturas = Factura::all();

        foreach ($facturas as $factura) {
            $factura->facturas_productos;
        }
        return response()->json([
            'facturas' => $facturas,

        ]);
    }

    function buscarFactura($id)
    { {
            $factura = Factura::find($id);
            $factura->platos_factura;
            return response()->json([
                'factura' => $factura,
            ]);
        }
    }


    function addFacturaMesa(Request $request) {
        $idMesa = $request->input('idMesa');
        $mesa = Mesa::find($idMesa);
        $mesaDisponible = $mesa->disponible;
        if ($mesaDisponible == 0){
            $fechaHoraActual = Carbon::now();
            $factura = new Factura();
            $factura->fecha_Hora = $fechaHoraActual;
            $factura->total = 0;
            $factura->idMesa = $idMesa;

            $factura->save();
            return response()->json(['msg'=> "Registro guardado"]);
        }   
        else {
                return response()->json(['message' => 'mesa ocupada'], 404);
            }
    }


    function addProductoMesa(Request $request) {
        $mesaID = $request->input('idMesa');
        $productoID = $request->input('idProducto');

        $facturaReciente = Factura::where('idMesa', $mesaID)->orderBy('fecha_Hora', 'desc')->first();
        $facturaIDreciente = $facturaReciente->idFacturas;
        
        // Buscar la factura y la carta en la base de datos
        $factura = Factura::find($facturaIDreciente);
        $producto = Producto::find($productoID);

        // Verificar si se encontraron la factura y la producto
        if ($factura && $producto) {
            // Guardar la relación en la tabla pivot
            $factura->platos_factura()->attach($producto->idProducto);

            $platos = $factura->platos_factura;

            $total = 0;
            foreach ($platos as $plato) {
                $total += $plato->precio; // Sumar el precio de cada plato al total
            }
            $factura->total = $total; // Actualizar el campo 'total' en el modelo de Factura
            $factura->save();
            return response()->json(['message' => 'Registro insertado correctamente en la tabla pivot'], 201);
        } else {
            return response()->json(['message' => 'Factura o producto no encontrada'], 404);
        }
    }



}
