<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    public function show($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);

        return view('ventas.show', compact('venta'));
    }

    public function buscarPorCodigo($codigo)
    {
        $producto = Producto::where('codigo_barra', $codigo)->first();

        if ($producto) {
            return response()->json(['success' => true, 'producto' => $producto]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function index()
    {
        $ventas = Venta::orderBy('created_at', 'desc')->paginate(5);
        $productos = Producto::all();

        return view('ventas.index', compact('ventas', 'productos'));
    }

    public function store(Request $request)
{
    // Validar los datos entrantes
    $validated = $request->validate([
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
    ]);

    // Preparar datos para validación de stock
    $productosIds = collect($request->productos)->pluck('producto_id');
    $productos = Producto::whereIn('id', $productosIds)->get()->keyBy('id');

    // Validar stock
    $erroresStock = [];
    foreach ($request->productos as $item) {
        $producto = $productos[$item['producto_id']];
        if ($producto->stock < $item['cantidad']) {
            $erroresStock[] = "{$producto->nombre}: Stock disponible {$producto->stock}";
        }
    }

    if (!empty($erroresStock)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Error de stock - ' . implode(', ', $erroresStock));
    }

    DB::beginTransaction();
    try {
        $total = 0;
        $venta = Venta::create(['total' => 0]);

        foreach ($request->productos as $item) {
            $producto = $productos[$item['producto_id']];
            $subtotal = $producto->precio_venta * $item['cantidad'];
            $total += $subtotal;

            // Crear detalle de venta
            VentaDetalle::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio_venta,
                'subtotal' => $subtotal,
            ]);

            // Actualizar stock (forma más eficiente)
            $producto->decrement('stock', $item['cantidad']);
        }

        // Actualizar total de la venta
        $venta->update(['total' => $total]);

        DB::commit();

        return redirect()->route('ventas.index')
            ->with('success', "Venta #{$venta->id} registrada. Total: $" . number_format($total, 2));

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al registrar venta: ' . $e->getMessage());
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Error al registrar venta: ' . $e->getMessage());
    }
}
}
