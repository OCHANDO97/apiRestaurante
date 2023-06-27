<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idProducto';

    protected $fillable = ['idProducto','nombre','precio','tipo','idCategoria'];

    public function categorias()
    {
        return $this->belongsTo(Categorias::class);
    }
    
    public function facturas()
    {
        return $this->belongsToMany(Facturas::class, 'facturas_productos');
    }
}
