<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\LogPersonalController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//rutas de productos
Route::resource('productos', ProductoController::class);
Route::patch('/productos/agregar-stock/{producto}', [ProductoController::class, 'agregarStock'])
    ->name('productos.agregarStock');

//rutas entrada

Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');

use App\Http\Controllers\VentaController;

Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
Route::get('/buscar-producto/{codigo}', [ProductoController::class, 'buscarPorCodigo']);

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])
    ->middleware('auth')->name('logs'); // <-- opcional para protegerlo

Route::get('/logs/personal', [LogPersonalController::class, 'index'])->name('logs.personal');

Route::get('/dashboard/ventas/{periodo}', [DashboardController::class, 'datosVentas']);


Route::get('/ventas/grafica', [DashboardController::class, 'graficaVentas'])->name('ventas.grafica');
Route::post('/ventas/filtrar', [DashboardController::class, 'filtrarVentas'])->name('ventas.filtrar');
