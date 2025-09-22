<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-6">
            <!-- Header con Logo y Menú -->
            <div class="flex items-center justify-between">
                <!-- Logo de Mi Ángel -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="text-white text-xl">👼</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">{{ Auth::user()->nombre_negocio ?: 'Mi Ángel' }}</h1>
                        <p class="text-xs text-gray-500">{{ Auth::user()->slogan ?: 'Juguería & Smoothies' }}</p>
                    </div>
                </div>

                <!-- Menú de Navegación -->
                <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-xl border border-green-200/50 p-2">
                    <div class="flex flex-wrap gap-1">
                        <a href="{{ route('ventas.index') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-700 hover:text-green-600 hover:bg-green-50 hover:shadow-md transform hover:scale-105">
                            <span class="mr-2 text-lg">💰</span>{{ __('Ventas') }}
                        </a>
                        <a href="{{ route('gastos.index') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-700 hover:text-green-600 hover:bg-green-50 hover:shadow-md transform hover:scale-105">
                            <span class="mr-2 text-lg">🛒</span>{{ __('Gastos') }}
                        </a>
                        <a href="{{ route('reportes.index') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg transform hover:scale-105">
                            <span class="mr-2 text-lg">📊</span>{{ __('Reportes') }}
                        </a>
                        <a href="{{ route('productos.index') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-700 hover:text-green-600 hover:bg-green-50 hover:shadow-md transform hover:scale-105">
                            <span class="mr-2 text-lg">🔧</span>{{ __('Ajustes') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Panel Unificado: Filtros + Estadísticas -->
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-2xl rounded-3xl border border-green-200/50 mb-8">
                <!-- Header con Filtros -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="text-white text-lg">📊</span>
                            </div>
                            <h3 class="text-xl font-bold text-white">Panel de Reportes</h3>
                        </div>
                        <form method="GET" action="{{ route('reportes.index') }}" class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="flex items-center space-x-3">
                                <label class="text-white text-sm font-medium">Período:</label>
                                <select name="filtro" class="px-4 py-2 border border-white/30 rounded-xl focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-200 bg-white/10 text-white backdrop-blur-sm">
                                    <option value="dia" {{ $filtro === 'dia' ? 'selected' : '' }} class="text-gray-900">📅 Hoy</option>
                                    <option value="semana" {{ $filtro === 'semana' ? 'selected' : '' }} class="text-gray-900">📊 Esta Semana</option>
                                    <option value="mes" {{ $filtro === 'mes' ? 'selected' : '' }} class="text-gray-900">📈 Este Mes</option>
                                </select>
                            </div>
                            <button type="submit" class="px-6 py-2 bg-white/20 text-white rounded-xl hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 font-semibold backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filtrar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Estadísticas Compactas -->
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Total Ventas -->
                        <div class="group bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4 border border-green-200/50 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <span class="text-white text-lg">💰</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-green-600">Total Ventas</div>
                                        <div class="text-xs text-green-500">Ingresos</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-bold text-green-600">S/ {{ number_format($totalVentas, 2) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Gastos -->
                        <div class="group bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl p-4 border border-red-200/50 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <span class="text-white text-lg">🛒</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-red-600">Total Gastos</div>
                                        <div class="text-xs text-red-500">Costos</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-bold text-red-600">S/ {{ number_format($totalGastos, 2) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Ganancia Neta -->
                        <div class="group bg-gradient-to-br {{ $gananciaNeta >= 0 ? 'from-blue-50 to-indigo-50' : 'from-orange-50 to-yellow-50' }} rounded-2xl p-4 border {{ $gananciaNeta >= 0 ? 'border-blue-200/50' : 'border-orange-200/50' }} hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br {{ $gananciaNeta >= 0 ? 'from-blue-500 to-indigo-600' : 'from-orange-500 to-yellow-600' }} rounded-xl flex items-center justify-center shadow-lg">
                                        <span class="text-white text-lg">{{ $gananciaNeta >= 0 ? '📈' : '📉' }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium {{ $gananciaNeta >= 0 ? 'text-blue-600' : 'text-orange-600' }}">Ganancia Neta</div>
                                        <div class="text-xs {{ $gananciaNeta >= 0 ? 'text-blue-500' : 'text-orange-500' }}">{{ $gananciaNeta >= 0 ? 'Beneficio' : 'Pérdida' }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xl font-bold {{ $gananciaNeta >= 0 ? 'text-blue-600' : 'text-orange-600' }}">S/ {{ number_format($gananciaNeta, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico Hermoso -->
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-2xl rounded-3xl border border-blue-200/50 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 rounded-3xl flex items-center justify-center">
                            <span class="text-white text-xl">📊</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Gráfico de Ventas vs Gastos</h3>
                            <p class="text-blue-100 text-sm">Análisis visual del período seleccionado</p>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="h-80 sm:h-96 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-4">
                        <canvas id="reportesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tablas de Detalle Hermosas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Tabla de Ventas -->
                <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-2xl rounded-3xl border border-green-200/50">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-3xl flex items-center justify-center">
                                <span class="text-white text-xl">💰</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Ventas Recientes</h3>
                                <p class="text-green-100 text-sm">Más reciente arriba</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($ventas->count() > 0)
                            <div class="space-y-3">
                                @foreach($ventas->take(8) as $venta)
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-4 border border-green-200/50 hover:shadow-md transition-all duration-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                                    <span class="text-white text-sm">💰</span>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $venta->producto->nombre }}</div>
                                                    <div class="text-sm text-gray-500">{{ $venta->cantidad }} unidades</div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-lg font-bold text-green-600">S/ {{ number_format($venta->total, 2) }}</div>
                                                <div class="text-xs text-gray-500">{{ $venta->fecha->format('H:i') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-gray-400 text-2xl">📊</span>
                                </div>
                                <p class="text-gray-500">No hay ventas registradas en este período</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tabla de Gastos -->
                <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-2xl rounded-3xl border border-red-200/50">
                    <div class="bg-gradient-to-r from-red-500 to-orange-600 px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-3xl flex items-center justify-center">
                                <span class="text-white text-xl">🛒</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Gastos Recientes</h3>
                                <p class="text-red-100 text-sm">Más reciente arriba</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($gastos->count() > 0)
                            <div class="space-y-3">
                                @foreach($gastos->take(8) as $gasto)
                                    <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl p-4 border border-red-200/50 hover:shadow-md transition-all duration-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-600 rounded-xl flex items-center justify-center">
                                                    <span class="text-white text-sm">🛒</span>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $gasto->producto->nombre }}</div>
                                                    <div class="text-sm text-gray-500">{{ $gasto->cantidad }} unidades</div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-lg font-bold text-red-600">S/ {{ number_format($gasto->total, 2) }}</div>
                                                <div class="text-xs text-gray-500">{{ $gasto->fecha->format('H:i') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-gray-400 text-2xl">📊</span>
                                </div>
                                <p class="text-gray-500">No hay gastos registrados en este período</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos del gráfico
        const chartData = @json($datosGrafico);
        
        // Configuración del gráfico hermoso
        const ctx = document.getElementById('reportesChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: '💰 Ventas',
                        data: chartData.ventas,
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(34, 197, 94)',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: 'rgb(34, 197, 94)',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 3
                    },
                    {
                        label: '🛒 Gastos',
                        data: chartData.gastos,
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.2)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(239, 68, 68)',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: 'rgb(239, 68, 68)',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': S/ ' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 12
                            },
                            callback: function(value) {
                                return 'S/ ' + value.toFixed(2);
                            }
                        }
                    }
                },
                elements: {
                    line: {
                        borderJoinStyle: 'round',
                        borderCapStyle: 'round'
                    }
                }
            }
        });
    </script>
</x-app-layout>
