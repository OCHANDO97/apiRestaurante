<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Mesa;
use Carbon\Carbon;
class FacturaController extends Controller
{

    public function store(Request $request, Mesa $mesa)
    {
        // Verificar si la mesa está disponible
        
        if ($mesa->disponible == 0) {
            // Crear una nueva factura
            $fechaHoraActual = Carbon::now();
            $factura = new Factura();
            $factura->fecha_Hora = $fechaHoraActual;
            $factura->total = 0;
            $factura->idMesa = $mesa->idMesa;
            $factura->save();
            $mesa->disponible = 1;
            $mesa->save();

            return response()->json(['message' => 'Factura creada correctamente'], 201);
        } else {
            return response()->json(['message' => 'Mesa ocupada'], 404);
        }
    }

    public function index()
    {

        $facturas = Factura::all();

        foreach ($facturas as $factura) {
            $factura->facturas_productos;
        }
        return response()->json([
            'facturas' => $facturas,

        ]);
    }

    function show($id)
    { 
        
            $factura = Factura::find($id);
            $factura->platos_factura;
            return response()->json([
                'factura' => $factura,
            ]);
        
    }



    function addProductoToFacturaOnMesa(Request $request, Mesa $mesa, Producto $producto) {

        $facturaReciente = Factura::where('idMesa', $mesa->idMesa)->orderBy('fecha_Hora', 'desc')->first();
        
        $producto = Producto::find($producto->idProducto);

        // Verificar si se encontraron la factura y la producto
        if ($facturaReciente && $producto) {
            // Guardar la relación en la tabla pivot
            $facturaReciente->facturas_productos()->attach($producto->idProducto);
            $facturaReciente->total += $producto->precio;
            $facturaReciente->save();
          
            return response()->json(['message' => 'Producto agregado a la factura'], 201);
        } else {
            return response()->json(['message' => 'Factura o producto no encontrada'], 404);
        }
    }
}
