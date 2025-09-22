<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        $user = auth()->user();
        return view('productos.index', compact('productos', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|in:venta,gasto',
                'precio' => 'required|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only(['nombre', 'tipo', 'precio']);
            
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('productos', 'public');
            }

            $producto = Producto::create($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto creado exitosamente.',
                    'producto' => $producto
                ]);
            }

            return redirect()->route('productos.index')
                ->with('success', 'Producto creado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el producto: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|in:venta,gasto',
                'precio' => 'required|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only(['nombre', 'tipo', 'precio']);
            
            if ($request->hasFile('foto')) {
                // Eliminar foto anterior si existe
                if ($producto->foto) {
                    Storage::disk('public')->delete($producto->foto);
                }
                $data['foto'] = $request->file('foto')->store('productos', 'public');
            }

            $producto->update($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto actualizado exitosamente.',
                    'producto' => $producto
                ]);
            }

            return redirect()->route('productos.index')
                ->with('success', 'Producto actualizado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el producto: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        try {
            // Eliminar foto si existe
            if ($producto->foto) {
                Storage::disk('public')->delete($producto->foto);
            }
            
            $producto->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto eliminado exitosamente.'
                ]);
            }

            return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar el producto: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('productos.index')
                ->with('error', 'Error al eliminar el producto.');
        }
    }
}
