<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyProductAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Código de acceso para productos (puedes cambiarlo)
        $requiredCode = 'MIRIAN2024';
        
        // Verificar si el usuario ya tiene acceso autorizado
        if (session('product_access_granted', false)) {
            return $next($request);
        }
        
        // Si es una petición AJAX, devolver error JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Acceso no autorizado. Código de acceso requerido.',
                'requires_access_code' => true
            ], 403);
        }
        
        // Para peticiones normales, redirigir a la página de código de acceso
        return redirect()->route('productos.access-code');
    }
}
