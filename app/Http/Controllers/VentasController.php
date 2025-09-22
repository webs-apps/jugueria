<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    public function index()
    {
        $productos = Producto::where('tipo', 'venta')->get();
        return view('ventas.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        $venta = Venta::create([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $producto->precio,
            'total' => $producto->precio * $request->cantidad,
            'user_id' => Auth::id(),
            'fecha' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Venta registrada exitosamente',
            'venta' => $venta->load('producto')
        ]);
    }
}
