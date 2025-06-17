<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    // Mostrar historial de entradas
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $entradas = Entrada::with('producto')
            ->when($buscar, function ($query, $buscar) {
                $query->whereHas('producto', function ($q) use ($buscar) {
                    $q->where('nombre', 'like', "%$buscar%")
                        ->orWhere('codigo_barras', 'like', "%$buscar%");
                });
            })
            ->latest()
            ->paginate(5); // 👈 Aquí aplicamos la paginación

        $productos = Producto::all();

        return view('entradas.index', compact('entradas', 'productos'));
    }


    // Guardar nueva entrada
    public function store(Request $request)
    {
        $request->validate([
            'codigo_barras' => 'required|string',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Buscar producto por código de barras
        $producto = Producto::where('codigo_barras', $request->codigo_barras)->first();

        if (!$producto) {
            return back()->withErrors(['codigo_barras' => 'Producto no encontrado.'])->withInput();
        }

        // Registrar entrada
        Entrada::create([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
        ]);

        // Actualizar stock del producto
        $producto->stock += $request->cantidad;
        $producto->save();

        return redirect()->route('entradas.index')->with('success', 'Entrada registrada con éxito.');
    }
}
