<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idMesa';
    protected $table = 'mesas';

    public function factura(){
        return $this->hasMany(Factura::class, 'Facturas');
    }
}
