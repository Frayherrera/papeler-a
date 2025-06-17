<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\VentaDetalle;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->input('filtro', '7dias');

        // Configuración inicial
        $groupBy = 'DATE(ventas.created_at)';
        $dateFormat = 'd M';
        $take = 7;
        $dateFilter = [['ventas.created_at', '>=', now()->subDays(7)]]; // Valor por defecto

        switch ($filtro) {
            case 'hoy':
                $dateFilter = [['ventas.created_at', '>=', today()]];
                $groupBy = 'HOUR(ventas.created_at)';
                $dateFormat = 'H:i';
                $take = 24;
                break;

            case '7dias':
                $dateFilter = [['ventas.created_at', '>=', now()->subDays(7)]];
                $groupBy = 'DATE(ventas.created_at)';
                $dateFormat = 'd M';
                $take = 7;
                break;

            case 'mes':
                $dateFilter = [
                    ['ventas.created_at', '>=', now()->startOfMonth()],
                    ['ventas.created_at', '<=', now()->endOfMonth()]
                ];
                $groupBy = 'DATE(ventas.created_at)';
                $dateFormat = 'd M';
                $take = 30;
                break;

            case 'semana':
                $dateFilter = [
                    ['ventas.created_at', '>=', now()->startOfWeek()],
                    ['ventas.created_at', '<=', now()->endOfWeek()]
                ];
                $groupBy = 'DATE(ventas.created_at)';
                $dateFormat = 'D d';
                $take = 7;
                break;
        }

        // Consulta para ventas
        $ventas = Venta::where($dateFilter)
            ->select(
                DB::raw($groupBy . ' as fecha'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->take($take)
            ->get();

        // Consulta para ganancias
        $ganancias = DB::table('ventas')
            ->join('venta_detalles', 'ventas.id', '=', 'venta_detalles.venta_id')
            ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
            ->where($dateFilter)
            ->select(
                DB::raw($groupBy . ' as fecha'),
                DB::raw('SUM((venta_detalles.precio_unitario - productos.precio_compra) * venta_detalles.cantidad) as ganancia')
            )
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->take($take)
            ->get();

        // Respuesta para AJAX
        if ($request->ajax()) {
            return response()->json([
                'labels' => $ventas->pluck('fecha')->map(function ($f) use ($dateFormat) {
                    return \Carbon\Carbon::parse($f)->format($dateFormat);
                }),
                'ventas' => $ventas->pluck('total'),
                'ganancias' => $ganancias->pluck('ganancia')
            ]);
        }

        return view('dashboard', [
            'totalProductos' => Producto::count(),
            'productosBajoStock' => Producto::where('stock', '<', 5)->get(),
            'ventasHoy' => Venta::whereDate('created_at', today())->sum('total'),
            'ventasMes' => Venta::whereMonth('created_at', now()->month)->sum('total'),
            'ultimasVentas' => Venta::with('detalles')->latest()->take(5)->get(),
            'labels' => $ventas->pluck('fecha')->map(function ($f) use ($dateFormat) {
                return \Carbon\Carbon::parse($f)->format($dateFormat);
            }),
            'ventas' => $ventas->pluck('total'),
            'ganancias' => $ganancias->pluck('ganancia'),
            'filtroActivo' => $filtro
        ]);
    }
}
