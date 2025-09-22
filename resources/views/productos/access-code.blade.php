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
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-700 hover:text-green-600 hover:bg-green-50 hover:shadow-md transform hover:scale-105">
                            <span class="mr-2 text-lg">📊</span>{{ __('Reportes') }}
                        </a>
                        <a href="{{ route('productos.access-code') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg transform hover:scale-105">
                            <span class="mr-2 text-lg">🔧</span>{{ __('Ajustes') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <!-- Card Principal -->
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-2xl rounded-3xl border border-green-200/50">
                <!-- Header con gradiente -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-8">
                    <div class="text-center">
                        <!-- Icono de seguridad -->
                        <div class="mx-auto w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">🔐 Acceso Restringido</h2>
                        <p class="text-green-100 text-sm">Ingresa el código de acceso para continuar</p>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="px-8 py-8">
                    <form id="accessCodeForm" class="space-y-6">
                        @csrf
                        
                        <!-- Campo de código -->
                        <div>
                            <label for="access_code" class="block text-sm font-medium text-gray-700 mb-3">
                                Código de Acceso
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                    </svg>
                                </div>
                                <input type="password" 
                                       id="access_code" 
                                       name="access_code" 
                                       required
                                       class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-center text-lg font-mono tracking-wider"
                                       placeholder="Ingresa el código"
                                       autocomplete="off">
                            </div>
                            @error('access_code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" 
                                class="w-full px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-200 font-semibold text-lg shadow-lg transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Verificar Código
                        </button>
                    </form>

                    <!-- Información adicional -->
                    <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-semibold text-blue-800 mb-1">Información de Seguridad</h4>
                                <p class="text-xs text-blue-700">Esta área está protegida para mantener la seguridad de los datos de productos. Solo personal autorizado puede acceder.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Manejar envío del formulario
        document.getElementById('accessCodeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mostrar notificación de carga
            const loadingId = showNotification('loading', 'Verificando código de acceso...', '🔐 Procesando');
            
            const formData = new FormData(this);
            
            fetch('{{ route("productos.verify-access") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                // Verificar si la respuesta es JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('La respuesta del servidor no es JSON válido');
                }
                
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Actualizar notificación de carga a éxito
                    notificationSystem.updateLoading(loadingId, 'success', '¡Código correcto! Acceso autorizado. 🔓✨', '🎉 ¡Acceso Concedido!');
                    // Redirigir a la página de productos
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    // Actualizar notificación de carga a error
                    notificationSystem.updateLoading(loadingId, 'error', data.message || 'Código de acceso incorrecto', '❌ Acceso Denegado');
                    // Limpiar el campo
                    document.getElementById('access_code').value = '';
                    document.getElementById('access_code').focus();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Actualizar notificación de carga a error
                notificationSystem.updateLoading(loadingId, 'error', 'Error de conexión: ' + error.message, '🚫 Error de Red');
            });
        });

        // Auto-focus en el campo de código
        document.getElementById('access_code').focus();

        // Limpiar el campo al escribir
        document.getElementById('access_code').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>
</x-app-layout>
