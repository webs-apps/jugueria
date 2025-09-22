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
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg transform hover:scale-105">
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
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-green-200/50">
                <div class="p-6 sm:p-8">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">🍹 Productos Disponibles</h3>
                        <p class="text-gray-600">Toca un producto para registrar una venta</p>
                        
                        @if($productos->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 sm:gap-6">
                                        @foreach($productos as $producto)
                                            <div class="group bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-2 border border-green-200/50 overflow-hidden"
                                                 onclick="openVentaModal({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }}, '{{ $producto->foto }}')">
                                                <div class="relative">
                                                    @if($producto->foto)
                                                        <img src="{{ Storage::url($producto->foto) }}" 
                                                             alt="{{ $producto->nombre }}" 
                                                             class="w-full h-32 sm:h-40 object-cover">
                                                    @else
                                                        <div class="w-full h-32 sm:h-40 bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                                            <span class="text-4xl sm:text-5xl">🍹</span>
                                                        </div>
                                                    @endif
                                                    <div class="absolute inset-0 bg-gradient-to-t from-green-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                    <div class="absolute top-3 right-3">
                                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-lg">
                                                            <span class="text-white text-sm font-bold">+</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-4 sm:p-5">
                                                    <h4 class="text-sm sm:text-base font-bold text-gray-900 mb-3 line-clamp-2">{{ $producto->nombre }}</h4>
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-lg sm:text-xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                                            S/ {{ number_format($producto->precio, 2) }}
                                                        </p>
                                                        <div class="text-xs text-green-600 font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                            Tocar para vender
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-gray-400 text-6xl mb-4">🍹</div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay productos de venta</h3>
                                <p class="text-gray-500 mb-4">Agrega productos en la sección de Ajustes para comenzar a vender.</p>
                                <a href="{{ route('productos.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Ir a Ajustes
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Venta -->
    <div id="ventaModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-4 sm:top-20 mx-auto p-4 sm:p-5 w-full max-w-md sm:max-w-lg">
            <div class="bg-white/95 backdrop-blur-md shadow-2xl rounded-3xl border border-pink-200/50 overflow-hidden">
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                <span class="text-white text-xl">💰</span>
                            </div>
                            <h3 class="text-xl font-bold text-white" id="modalTitle">Realizar Venta</h3>
                        </div>
                        <button onclick="closeVentaModal()" class="text-white/80 hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                
                <div class="mb-4">
                    <div id="modalProductImage" class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-gray-400 text-4xl">🍹</span>
                    </div>
                    <p class="text-sm text-gray-600" id="modalProductPrice">Precio: S/ 0.00</p>
                </div>

                <form id="ventaForm">
                    @csrf
                    <input type="hidden" id="producto_id" name="producto_id">
                    
                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-2">Cantidad</label>
                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="decreaseQuantity()" 
                                    class="w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" id="cantidad" name="cantidad" value="1" min="1" 
                                   class="w-20 text-center border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                   onchange="calculateTotal()">
                            <button type="button" onclick="increaseQuantity()" 
                                    class="w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-4">
                            <p class="text-sm text-gray-600 mb-1">Precio unitario:</p>
                            <p class="text-xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent" id="unitPrice">S/ 0.00</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6">
                            <p class="text-sm text-gray-600 mb-2">Total a pagar:</p>
                            <p class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent" id="totalAmount">S/ 0.00</p>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" onclick="closeVentaModal()" 
                                class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-200 font-medium">
                            Cancelar
                        </button>
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-200 font-medium shadow-lg">
                            ✨ Vender
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentProduct = null;
        let currentPrice = 0;

        function openVentaModal(id, nombre, precio, foto) {
            currentProduct = { id, nombre, precio };
            currentPrice = precio;
            
            document.getElementById('producto_id').value = id;
            document.getElementById('modalTitle').textContent = `Vender: ${nombre}`;
            document.getElementById('modalProductPrice').textContent = `Precio: S/ ${precio.toFixed(2)}`;
            document.getElementById('cantidad').value = 1;
            
            // Actualizar imagen del producto
            const imageContainer = document.getElementById('modalProductImage');
            if (foto) {
                imageContainer.innerHTML = `<img src="/storage/${foto}" alt="${nombre}" class="w-full h-32 object-cover rounded-lg">`;
            } else {
                imageContainer.innerHTML = '<span class="text-gray-400 text-4xl">🍹</span>';
            }
            
            calculateTotal();
            document.getElementById('ventaModal').classList.remove('hidden');
        }

        function closeVentaModal() {
            document.getElementById('ventaModal').classList.add('hidden');
        }

        function increaseQuantity() {
            const cantidad = document.getElementById('cantidad');
            cantidad.value = parseInt(cantidad.value) + 1;
            calculateTotal();
        }

        function decreaseQuantity() {
            const cantidad = document.getElementById('cantidad');
            if (parseInt(cantidad.value) > 1) {
                cantidad.value = parseInt(cantidad.value) - 1;
                calculateTotal();
            }
        }

        function calculateTotal() {
            const cantidad = parseInt(document.getElementById('cantidad').value);
            const total = currentPrice * cantidad;
            document.getElementById('totalAmount').textContent = `S/ ${total.toFixed(2)}`;
            document.getElementById('unitPrice').textContent = `S/ ${currentPrice.toFixed(2)}`;
        }

        // Manejar envío del formulario
        document.getElementById('ventaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mostrar notificación de carga
            const loadingId = showNotification('loading', 'Procesando venta...', '💰 Vendiendo');
            
            const formData = new FormData(this);
            
            fetch('{{ route("ventas.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Actualizar notificación de carga a éxito
                    notificationSystem.updateLoading(loadingId, 'success', '¡Venta registrada exitosamente! 💰✨', '🎉 ¡Vendido!');
                    closeVentaModal();
                    // Recargar la página para mostrar los cambios
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    // Actualizar notificación de carga a error
                    notificationSystem.updateLoading(loadingId, 'error', data.message || 'Error desconocido al registrar la venta', '❌ Error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Actualizar notificación de carga a error
                notificationSystem.updateLoading(loadingId, 'error', 'Error de conexión: ' + error.message, '🚫 Error de Red');
            });
        });

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('ventaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVentaModal();
            }
        });
    </script>
</x-app-layout>
