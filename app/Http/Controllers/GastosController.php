<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastosController extends Controller
{
    public function index()
    {
        $productos = Producto::where('tipo', 'gasto')->get();
        return view('gastos.index', compact('productos'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'cantidad' => 'required|integer|min:1',
                'precio_total' => 'required|numeric|min:0.01',
            ]);

            $producto = Producto::findOrFail($request->producto_id);
            $precio_unitario = $request->precio_total / $request->cantidad;
            
            $gasto = Gasto::create([
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $precio_unitario,
                'total' => $request->precio_total,
                'user_id' => Auth::id(),
                'fecha' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Gasto registrado exitosamente',
                'gasto' => $gasto->load('producto')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el gasto: ' . $e->getMessage()
            ], 500);
        }
    }
}
