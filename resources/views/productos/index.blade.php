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
                        <a href="{{ route('productos.index') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg transform hover:scale-105">
                            <span class="mr-2 text-lg">🔧</span>{{ __('Ajustes') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('status') === 'profile-updated')
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    ¡Perfil actualizado exitosamente!
                </div>
            @endif

            <!-- Pestañas de Navegación -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-green-200/50 mb-6">
                <div class="p-2">
                    <div class="flex space-x-2">
                        <button onclick="showTab('productos')" 
                                id="tab-productos"
                                class="tab-button flex-1 inline-flex items-center justify-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg">
                            <span class="mr-2 text-lg">📦</span>Productos
                        </button>
                        <button onclick="showTab('configuracion')" 
                                id="tab-configuracion"
                                class="tab-button flex-1 inline-flex items-center justify-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-700 hover:text-green-600 hover:bg-green-50 hover:shadow-md">
                            <span class="mr-2 text-lg">⚙️</span>Configuración
                        </button>
                        <button onclick="revokeAccess()" 
                                class="inline-flex items-center justify-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-lg hover:from-red-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Cerrar Acceso
                        </button>
                    </div>
                </div>
            </div>

            <!-- Contenido de Productos -->
            <div id="content-productos">
                <!-- Filtros por tipo y Agregar Producto -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-green-200/50 mb-6">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0 mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Filtrar por tipo</h3>
                        <div class="flex gap-3">
                            <button onclick="openAddProductModal()" 
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Agregar Producto
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button onclick="filterProducts('all')" 
                                class="filter-btn px-6 py-3 rounded-2xl font-medium transition-all duration-200 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg">
                            📦 Todos
                        </button>
                        <button onclick="filterProducts('venta')" 
                                class="filter-btn px-6 py-3 rounded-2xl font-medium transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            💰 Ventas
                        </button>
                        <button onclick="filterProducts('gasto')" 
                                class="filter-btn px-6 py-3 rounded-2xl font-medium transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            🛒 Gastos
                        </button>
                    </div>
                </div>
            </div>

            <!-- Lista de Productos -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-green-200/50">
                <div class="p-6 sm:p-8">
                    @if($productos->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6" id="productosGrid">
                            @foreach($productos as $producto)
                                <div class="producto-card group bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-green-100/50 overflow-hidden" 
                                     data-tipo="{{ $producto->tipo }}">
                                    <div class="relative">
                                        @if($producto->foto)
                                            <img src="{{ Storage::url($producto->foto) }}" 
                                                 alt="{{ $producto->nombre }}" 
                                                 class="w-full h-40 sm:h-48 object-cover">
                                        @else
                                            <div class="w-full h-40 sm:h-48 bg-gradient-to-br {{ $producto->tipo === 'venta' ? 'from-green-100 to-emerald-100' : 'from-green-100 to-emerald-100' }} flex items-center justify-center">
                                                <span class="text-4xl sm:text-5xl">
                                                    {{ $producto->tipo === 'venta' ? '🍹' : '🛒' }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="absolute top-3 right-3">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $producto->tipo === 'venta' ? 'bg-green-500 text-white' : 'bg-emerald-500 text-white' }}">
                                                {{ ucfirst($producto->tipo) }}
                                            </span>
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="p-4 sm:p-6">
                                        <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $producto->nombre }}</h4>
                                        <p class="text-xl font-bold {{ $producto->tipo === 'venta' ? 'bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent' : 'bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent' }} mb-4">
                                            S/ {{ number_format($producto->precio, 2) }}
                                        </p>
                                        <div class="flex space-x-2">
                                            <button onclick="openEditProductModal({{ $producto->id }}, '{{ $producto->nombre }}', '{{ $producto->tipo }}', {{ $producto->precio }}, '{{ $producto->foto }}')" 
                                                    class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-200 font-medium text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Editar
                                            </button>
                                            <button type="button" 
                                                    onclick="deleteProduct({{ $producto->id }}, '{{ $producto->nombre }}')"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">📦</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay productos registrados</h3>
                            <p class="text-gray-500 mb-4">Comienza agregando productos para ventas y gastos.</p>
                            <a href="{{ route('productos.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Agregar Primer Producto
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Producto -->
    <div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold">Agregar Nuevo Producto</h3>
                    <button onclick="closeAddProductModal()" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <form id="addProductForm" class="p-6 space-y-4">
                @csrf
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                           placeholder="Ej: Jugo de Naranja">
                </div>
                
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Producto</label>
                    <select id="tipo" name="tipo" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        <option value="">Selecciona un tipo</option>
                        <option value="venta">Venta</option>
                        <option value="gasto">Gasto</option>
                    </select>
                </div>
                
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio Unitario</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">S/</span>
                        <input type="number" id="precio" name="precio" step="0.01" min="0" required
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                               placeholder="0.00">
                    </div>
                </div>
                
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto del Producto (Opcional)</label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                </div>
                
                <div class="flex space-x-4 pt-4">
                    <button type="button" onclick="closeAddProductModal()"
                            class="flex-1 px-6 py-3 border border-gray-300 rounded-2xl font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                        Agregar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function filterProducts(tipo) {
            const cards = document.querySelectorAll('.producto-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Actualizar botones
            buttons.forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'text-white', 'shadow-lg');
                btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            });
            
            event.target.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            event.target.classList.add('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'text-white', 'shadow-lg');
            
            // Filtrar tarjetas
            cards.forEach(card => {
                if (tipo === 'all' || card.dataset.tipo === tipo) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function openAddProductModal() {
            document.getElementById('addProductModal').classList.remove('hidden');
        }

        function closeAddProductModal() {
            document.getElementById('addProductModal').classList.add('hidden');
            document.getElementById('addProductForm').reset();
        }

        // Manejar envío del formulario
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mostrar notificación de carga
            const loadingId = showNotification('loading', 'Creando producto...', '🔧 Procesando');
            
            const formData = new FormData(this);
            
            fetch('{{ route("productos.store") }}', {
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
                    notificationSystem.updateLoading(loadingId, 'success', '¡Producto creado exitosamente! 🛍️✨', '🎉 ¡Creado!');
                    closeAddProductModal();
                    // Recargar la página para mostrar el nuevo producto
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    // Actualizar notificación de carga a error
                    notificationSystem.updateLoading(loadingId, 'error', data.message || 'Error desconocido al crear el producto', '❌ Error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Actualizar notificación de carga a error
                notificationSystem.updateLoading(loadingId, 'error', 'Error de conexión: ' + error.message, '🚫 Error de Red');
            });
        });

        // Cerrar modal al hacer clic fuera
        document.getElementById('addProductModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddProductModal();
            }
        });

        // Cerrar modal de editar al hacer clic fuera
        document.getElementById('editProductModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditProductModal();
            }
        });

        // Manejar envío del formulario de editar
        document.getElementById('editProductForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mostrar notificación de carga
            const loadingId = showNotification('loading', 'Actualizando producto...', '✏️ Procesando');
            
            const formData = new FormData(this);
            
            fetch(this.action, {
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
                return response.json();
            })
            .then(data => {
                if (data.success !== false) {
                    // Actualizar notificación de carga a éxito
                    notificationSystem.updateLoading(loadingId, 'success', '¡Producto actualizado exitosamente! ✏️✨', '🎉 ¡Actualizado!');
                    closeEditProductModal();
                    // Recargar la página para mostrar los cambios
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    // Actualizar notificación de carga a error
                    notificationSystem.updateLoading(loadingId, 'error', data.message || 'Error al actualizar el producto', '❌ Error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Actualizar notificación de carga a error
                notificationSystem.updateLoading(loadingId, 'error', 'Error de conexión: ' + error.message, '🚫 Error de Red');
            });
        });

        // Preview de imagen para el modal de editar
        document.getElementById('edit_foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'mx-auto h-24 w-24 object-cover rounded-md';
                    
                    const container = document.querySelector('#editProductModal .space-y-1.text-center');
                    const existingPreview = container.querySelector('img');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    container.insertBefore(preview, container.firstChild);
                };
                reader.readAsDataURL(file);
            }
        });

        // Función para eliminar producto con notificaciones hermosas
        function deleteProduct(productId, productName) {
            // Mostrar notificación de confirmación
            const confirmId = showNotification('warning', 
                `¿Estás seguro de que quieres eliminar "${productName}"? Esta acción no se puede deshacer.`, 
                '⚠️ Confirmar Eliminación', 
                15000
            );

            // Crear botones de confirmación
            setTimeout(() => {
                const notification = document.getElementById(confirmId);
                if (notification) {
                    const buttonContainer = document.createElement('div');
                    buttonContainer.className = 'flex space-x-3 mt-4';
                    buttonContainer.innerHTML = `
                        <button onclick="confirmDelete(${productId}, '${productName}')" 
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-xl hover:from-red-600 hover:to-pink-700 transition-all duration-200 font-semibold shadow-lg transform hover:scale-105">
                            🗑️ Sí, Eliminar
                        </button>
                        <button onclick="notificationSystem.hide('${confirmId}')" 
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-200 font-semibold shadow-lg transform hover:scale-105">
                            ❌ Cancelar
                        </button>
                    `;
                    notification.querySelector('.flex-1').appendChild(buttonContainer);
                }
            }, 100);
        }

        // Función para revocar acceso
        function revokeAccess() {
            // Mostrar notificación de confirmación
            const confirmId = showNotification('warning', 
                '¿Estás seguro de que quieres cerrar el acceso a productos? Tendrás que ingresar el código nuevamente.', 
                '⚠️ Confirmar Cierre de Acceso', 
                10000
            );

            // Crear botones de confirmación
            setTimeout(() => {
                const notification = document.getElementById(confirmId);
                if (notification) {
                    const buttonContainer = document.createElement('div');
                    buttonContainer.className = 'flex space-x-3 mt-4';
                    buttonContainer.innerHTML = `
                        <button onclick="confirmRevokeAccess()" 
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-xl hover:from-red-600 hover:to-pink-700 transition-all duration-200 font-semibold shadow-lg transform hover:scale-105">
                            🔒 Sí, Cerrar Acceso
                        </button>
                        <button onclick="notificationSystem.hide('${confirmId}')" 
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-200 font-semibold shadow-lg transform hover:scale-105">
                            ❌ Cancelar
                        </button>
                    `;
                    notification.querySelector('.flex-1').appendChild(buttonContainer);
                }
            }, 100);
        }

        // Función para confirmar revocación de acceso
        function confirmRevokeAccess() {
            // Ocultar notificación de confirmación
            notificationSystem.hideAll();
            
            // Mostrar notificación de carga
            const loadingId = showNotification('loading', 'Cerrando acceso...', '🔒 Procesando');
            
            // Enviar petición para revocar acceso
            fetch('{{ route("productos.revoke-access") }}', {
                method: 'POST',
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
                return response.json();
            })
            .then(data => {
                if (data.success !== false) {
                    // Actualizar notificación de carga a éxito
                    notificationSystem.updateLoading(loadingId, 'success', '¡Acceso cerrado exitosamente! 🔒✨', '🎉 ¡Acceso Revocado!');
                    // Redirigir a la página de ventas
                    setTimeout(() => {
                        window.location.href = data.redirect || '{{ route("ventas.index") }}';
                    }, 1500);
                } else {
                    // Actualizar notificación de carga a error
                    notificationSystem.updateLoading(loadingId, 'error', data.message || 'Error al cerrar el acceso', '❌ Error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Actualizar notificación de carga a error
                notificationSystem.updateLoading(loadingId, 'error', 'Error de conexión: ' + error.message, '🚫 Error de Red');
            });
        }

        // Función para abrir modal de editar producto
        function openEditProductModal(productId, productName, productType, productPrice, productPhoto) {
            // Llenar el formulario con los datos del producto
            document.getElementById('edit_nombre').value = productName;
            document.getElementById('edit_tipo').value = productType;
            document.getElementById('edit_precio').value = productPrice;
            
            // Mostrar imagen actual si existe
            const currentImageContainer = document.getElementById('currentImageContainer');
            const currentImage = document.getElementById('currentImage');
            const keepCurrentImageText = document.getElementById('keepCurrentImageText');
            
            if (productPhoto) {
                currentImage.src = `/storage/${productPhoto}`;
                currentImage.alt = productName;
                currentImageContainer.classList.remove('hidden');
                keepCurrentImageText.classList.remove('hidden');
            } else {
                currentImageContainer.classList.add('hidden');
                keepCurrentImageText.classList.add('hidden');
            }
            
            // Actualizar la acción del formulario
            document.getElementById('editProductForm').action = `/productos/${productId}`;
            
            // Mostrar el modal
            document.getElementById('editProductModal').classList.remove('hidden');
        }

        // Función para cerrar modal de editar producto
        function closeEditProductModal() {
            document.getElementById('editProductModal').classList.add('hidden');
            document.getElementById('editProductForm').reset();
            document.getElementById('currentImageContainer').classList.add('hidden');
            document.getElementById('keepCurrentImageText').classList.add('hidden');
        }

        // Función para confirmar eliminación
        function confirmDelete(productId, productName) {
            // Ocultar notificación de confirmación
            notificationSystem.hideAll();
            
            // Mostrar notificación de carga
            const loadingId = showNotification('loading', 'Eliminando producto...', '🗑️ Procesando');
            
            // Crear formulario temporal para eliminar
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/productos/${productId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            
            // Enviar formulario
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken.value,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success !== false) {
                    // Actualizar notificación de carga a éxito
                    notificationSystem.updateLoading(loadingId, 'success', `¡"${productName}" eliminado exitosamente! 🗑️✨`, '🎉 ¡Eliminado!');
                    // Recargar la página para mostrar los cambios
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    // Actualizar notificación de carga a error
                    notificationSystem.updateLoading(loadingId, 'error', data.message || 'Error al eliminar el producto', '❌ Error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Actualizar notificación de carga a error
                notificationSystem.updateLoading(loadingId, 'error', 'Error de conexión: ' + error.message, '🚫 Error de Red');
            })
            .finally(() => {
                // Limpiar formulario temporal
                document.body.removeChild(form);
            });
        }

        // Funciones para manejar las pestañas
        function showTab(tabName) {
            // Ocultar todos los contenidos
            document.getElementById('content-productos').classList.add('hidden');
            document.getElementById('content-configuracion').classList.add('hidden');
            
            // Remover estilos activos de todas las pestañas
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'text-white', 'shadow-lg');
                button.classList.add('text-gray-700', 'hover:text-green-600', 'hover:bg-green-50', 'hover:shadow-md');
            });
            
            // Mostrar el contenido seleccionado
            if (tabName === 'productos') {
                document.getElementById('content-productos').classList.remove('hidden');
                document.getElementById('tab-productos').classList.remove('text-gray-700', 'hover:text-green-600', 'hover:bg-green-50', 'hover:shadow-md');
                document.getElementById('tab-productos').classList.add('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'text-white', 'shadow-lg');
            } else if (tabName === 'configuracion') {
                document.getElementById('content-configuracion').classList.remove('hidden');
                document.getElementById('tab-configuracion').classList.remove('text-gray-700', 'hover:text-green-600', 'hover:bg-green-50', 'hover:shadow-md');
                document.getElementById('tab-configuracion').classList.add('bg-gradient-to-r', 'from-green-500', 'to-emerald-600', 'text-white', 'shadow-lg');
            }
        }

        // Función para cerrar sesión
        function logout() {
            if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                // Crear un formulario temporal para enviar la petición POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                
                // Agregar token CSRF
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.appendChild(csrfToken);
                
                // Agregar al DOM y enviar
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Inicializar con la pestaña de productos activa
        document.addEventListener('DOMContentLoaded', function() {
            showTab('productos');
        });
    </script>

    <!-- Modal para Editar Producto -->
    <div id="editProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold">Editar Producto</h3>
                    <button onclick="closeEditProductModal()" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <form id="editProductForm" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Imagen actual -->
                <div id="currentImageContainer" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Actual</label>
                    <div class="w-32 h-32 border border-gray-300 rounded-lg overflow-hidden">
                        <img id="currentImage" src="" alt="" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Nombre del Producto -->
                <div>
                    <label for="edit_nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Producto</label>
                    <input type="text" id="edit_nombre" name="nombre" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                           placeholder="Ej: Jugo de Naranja">
                </div>
                
                <!-- Tipo de Producto -->
                <div>
                    <label for="edit_tipo" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Producto</label>
                    <select id="edit_tipo" name="tipo" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        <option value="">Selecciona un tipo</option>
                        <option value="venta">Venta (Productos que vendes)</option>
                        <option value="gasto">Gasto (Insumos que compras)</option>
                    </select>
                </div>
                
                <!-- Precio Unitario -->
                <div>
                    <label for="edit_precio" class="block text-sm font-medium text-gray-700 mb-2">Precio Unitario</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">S/</span>
                        <input type="number" id="edit_precio" name="precio" step="0.01" min="0" required
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                               placeholder="0.00">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Para productos de venta: precio al que vendes cada unidad<br>
                        Para productos de gasto: precio de referencia (se puede modificar al registrar gastos)
                    </p>
                </div>
                
                <!-- Nueva Foto del Producto -->
                <div>
                    <label for="edit_foto" class="block text-sm font-medium text-gray-700 mb-2">Nueva Foto del Producto (Opcional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-green-400 transition-colors duration-200">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="edit_foto" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                    <span>Cambiar foto</span>
                                    <input id="edit_foto" name="foto" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">o arrastra y suelta</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                            <p id="keepCurrentImageText" class="text-xs text-gray-400 hidden">Dejar vacío para mantener la imagen actual</p>
                        </div>
                    </div>
                </div>
                
                <!-- Botones -->
                <div class="flex space-x-4 pt-4">
                    <button type="button" onclick="closeEditProductModal()"
                            class="flex-1 px-6 py-3 border border-gray-300 rounded-2xl font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Actualizar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contenido de Configuración -->
    <div id="content-configuracion" class="hidden">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Profile Information Card -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-green-200/50">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">👤</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Información del Perfil</h3>
                            <p class="text-sm text-gray-600">Actualiza la información de tu perfil y dirección de correo</p>
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-green-200/50">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">🔒</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Actualizar Contraseña</h3>
                            <p class="text-sm text-gray-600">Asegúrate de usar una contraseña larga y segura</p>
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Logout Card -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-orange-200/50">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">🚪</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Cerrar Sesión</h3>
                            <p class="text-sm text-gray-600">Cierra tu sesión actual de forma segura</p>
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        <button type="button" onclick="logout()" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-orange-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-red-200/50">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-lg">⚠️</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Eliminar Cuenta</h3>
                            <p class="text-sm text-gray-600">Elimina permanentemente tu cuenta y todos sus datos</p>
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

