<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filtro = $request->get('filtro', 'dia');
        
        // Obtener fechas según el filtro
        $fechas = $this->getFechasFiltro($filtro);
        
        // Ventas del usuario (ordenadas por fecha descendente - más reciente primero)
        $ventas = Venta::where('user_id', $user->id)
            ->whereBetween('fecha', [$fechas['inicio'], $fechas['fin']])
            ->with('producto')
            ->orderBy('fecha', 'desc')
            ->get();
            
        // Gastos del usuario (ordenados por fecha descendente - más reciente primero)
        $gastos = Gasto::where('user_id', $user->id)
            ->whereBetween('fecha', [$fechas['inicio'], $fechas['fin']])
            ->with('producto')
            ->orderBy('fecha', 'desc')
            ->get();
        
        // Calcular totales
        $totalVentas = $ventas->sum('total');
        $totalGastos = $gastos->sum('total');
        $gananciaNeta = $totalVentas - $totalGastos;
        
        // Datos para gráficos
        $datosGrafico = $this->prepararDatosGrafico($ventas, $gastos, $filtro);
        
        return view('reportes.index', compact(
            'ventas', 
            'gastos', 
            'totalVentas', 
            'totalGastos', 
            'gananciaNeta',
            'filtro',
            'datosGrafico'
        ));
    }
    
    private function getFechasFiltro($filtro)
    {
        $hoy = now();
        
        switch ($filtro) {
            case 'semana':
                return [
                    'inicio' => $hoy->copy()->startOfWeek(),
                    'fin' => $hoy->copy()->endOfWeek()
                ];
            case 'mes':
                return [
                    'inicio' => $hoy->copy()->startOfMonth(),
                    'fin' => $hoy->copy()->endOfMonth()
                ];
            default: // dia
                return [
                    'inicio' => $hoy->copy()->startOfDay(),
                    'fin' => $hoy->copy()->endOfDay()
                ];
        }
    }
    
    private function prepararDatosGrafico($ventas, $gastos, $filtro)
    {
        $datos = [];
        
        if ($filtro === 'dia') {
            // Por horas del día
            for ($i = 0; $i < 24; $i++) {
                $hora = sprintf('%02d:00', $i);
                $datos['labels'][] = $hora;
                $datos['ventas'][] = $ventas->where('fecha.hour', $i)->sum('total');
                $datos['gastos'][] = $gastos->where('fecha.hour', $i)->sum('total');
            }
        } else {
            // Por días de la semana/mes
            $fechas = $this->getFechasFiltro($filtro);
            $periodo = $fechas['inicio']->daysUntil($fechas['fin']);
            
            foreach ($periodo as $fecha) {
                $datos['labels'][] = $fecha->format('d/m');
                $datos['ventas'][] = $ventas->where('fecha.date', $fecha->toDateString())->sum('total');
                $datos['gastos'][] = $gastos->where('fecha.date', $fecha->toDateString())->sum('total');
            }
        }
        
        return $datos;
    }
}
