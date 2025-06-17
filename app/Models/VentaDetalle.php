<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ventaDetalle extends Model
{
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];
}
