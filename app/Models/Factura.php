<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idFacturas';

    public function mesa(){
        return $this->belongsTo(Mesa::class, 'idFacturas', 'idMesa');
    }

    public function facturas_productos(){
        return $this->belongsToMany(Producto::class, 'facturas_productos', 'idFacturas', 'idProducto');
    }
}
