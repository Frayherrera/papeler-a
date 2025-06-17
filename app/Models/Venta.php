<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function usuario()
{
    return $this->belongsTo(User::class);
}

public function detalles()
{
    return $this->hasMany(VentaDetalle::class);
}
protected $fillable = [
        'total'
    ];
}
