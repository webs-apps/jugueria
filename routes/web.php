<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProductAccessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('ventas.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route (required by Laravel Breeze)
    Route::get('/dashboard', function () {
        return redirect()->route('ventas.index');
    })->name('dashboard');
    
    // Main sections
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
    
    Route::get('/gastos', [GastosController::class, 'index'])->name('gastos.index');
    Route::post('/gastos', [GastosController::class, 'store'])->name('gastos.store');
    
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
    
    // Profile routes (required by Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Configuración routes (custom) - Redirigir a productos
    Route::get('/configuracion', function () {
        return redirect()->route('productos.index');
    })->name('configuracion.edit');
    Route::patch('/configuracion', [ProfileController::class, 'update'])->name('configuracion.update');
    Route::delete('/configuracion', [ProfileController::class, 'destroy'])->name('configuracion.destroy');
    
    // Product access routes
    Route::get('/productos/access-code', [ProductAccessController::class, 'showAccessCodeForm'])->name('productos.access-code');
    Route::post('/productos/verify-access', [ProductAccessController::class, 'verifyAccessCode'])->name('productos.verify-access');
    Route::post('/productos/revoke-access', [ProductAccessController::class, 'revokeAccess'])->name('productos.revoke-access');
    
    // Product management (Ajustes) - Protegido con código de acceso
    Route::middleware('product.access')->group(function () {
        Route::resource('productos', ProductosController::class);
    });
    
    // Ruta de prueba para AJAX
    Route::post('/test-ajax', function (Request $request) {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'AJAX funcionando correctamente',
                'data' => $request->all()
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No es una petición AJAX']);
    });
});

require __DIR__.'/auth.php';
