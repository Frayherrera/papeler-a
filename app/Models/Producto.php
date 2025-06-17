<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $fillable = [
        'codigo_barras',
        'nombre',
        'stock',
        'precio_venta',
        'precio_compra'
    ];

    public function entradaDetalles()
    {
        return $this->hasMany(EntradaDetalle::class);
    }

    public function ventaDetalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }
}
