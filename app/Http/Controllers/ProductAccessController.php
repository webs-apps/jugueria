<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductAccessController extends Controller
{
    /**
     * Mostrar el formulario de código de acceso
     */
    public function showAccessCodeForm()
    {
        return view('productos.access-code');
    }

    /**
     * Verificar el código de acceso
     */
    public function verifyAccessCode(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string'
        ]);

        $enteredCode = $request->input('access_code');
        $requiredCode = 'MIRIAN2024'; // Código de acceso

        if ($enteredCode === $requiredCode) {
            // Código correcto, autorizar acceso
            session(['product_access_granted' => true]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Código de acceso correcto. Acceso autorizado.',
                    'redirect' => route('productos.index')
                ]);
            }
            
            return redirect()->route('productos.index')
                ->with('success', 'Código de acceso correcto. Acceso autorizado.');
        } else {
            // Código incorrecto
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Código de acceso incorrecto. Intenta nuevamente.'
                ], 422);
            }
            
            return back()->withErrors([
                'access_code' => 'Código de acceso incorrecto. Intenta nuevamente.'
            ]);
        }
    }

    /**
     * Revocar el acceso (logout del código)
     */
    public function revokeAccess()
    {
        session()->forget('product_access_granted');
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Acceso revocado exitosamente.',
                'redirect' => route('ventas.index')
            ]);
        }
        
        return redirect()->route('ventas.index')
            ->with('success', 'Acceso revocado exitosamente.');
    }
}
