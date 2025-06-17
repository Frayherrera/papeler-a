<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('buscar')) {
            $busqueda = $request->buscar;

            $query->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'like', '%' . $busqueda . '%')
                    ->orWhere('codigo_barras', 'like', '%' . $busqueda . '%');
            });
        }

        $productos = $query->orderBy('created_at', 'desc')->paginate(4);

        return view('productos.index', compact('productos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_barras' => 'required|string|unique:productos',
            'nombre' => 'required|string',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) use ($request) {
                if ($value <= $request->precio_compra) {
                    $fail('El precio de venta debe ser mayor que el precio de compra.');
                }
            }],
        ]);

        try {
            $producto = Producto::create($validated);

            // ✅ Log de éxito
            Log::channel('personal')->info('Producto registrado', [
                'usuario_id' => Auth::id(),
                'producto_id' => $producto->id,
                'codigo_barras' => $producto->codigo_barras,
                'nombre' => $producto->nombre,
            ]);

            Session::flash('success', 'Producto registrado correctamente.');
            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            // ❌ Log de error
            Log::channel('personal')->error('Error al registrar producto', [
                'error' => $e->getMessage(),
                'usuario_id' => Auth::id(),
                'request_data' => $request->all(),
            ]);

            return back()->withErrors('Ocurrió un error al guardar el producto.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function agregarStock(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto->stock += $request->cantidad;
        $producto->save();

        return redirect()->back()->with('success', 'Stock actualizado correctamente.');
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'codigo_barras' => 'required|string|unique:productos,codigo_barras,' . $producto->id,
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'precio_venta' => 'required|numeric|min:0',
        ]);

        try {
            $producto->update($validated);
            Session::flash('success', 'Producto actualizado correctamente.');
            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return back()->withErrors('Ocurrió un error al actualizar el producto.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            Log::channel('personal')->info('Producto eliminado', [
                'producto_id' => $producto->id,
                'usuario_id' => Auth::id(),
                'codigo_barras' => $producto->codigo_barras,
                'nombre' => $producto->nombre,
            ]);
            Session::flash('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar producto: ' . $e->getMessage());
            Session::flash('error', 'No se pudo eliminar el producto.');
        }

        return redirect()->route('productos.index');
    }
}
