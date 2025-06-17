<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntradaDetalle extends Model
{
    public function entrada()
{
    return $this->belongsTo(Entrada::class);
}

public function producto()
{
    return $this->belongsTo(Producto::class);
}
}
