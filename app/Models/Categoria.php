<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categorias';
    protected $primaryKey = 'idCategoria';

    public function carta()
    {
        return $this->hasMany(Carta::class);
    }
}
