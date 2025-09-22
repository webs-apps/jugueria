<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('productos.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar Nuevo Producto') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Nombre del Producto -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre del Producto
                                </label>
                                <input type="text" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="{{ old('nombre') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('nombre') border-red-500 @enderror"
                                       placeholder="Ej: Jugo de Naranja, Azúcar, Vasos Descartables..."
                                       required>
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tipo de Producto -->
                            <div>
                                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipo de Producto
                                </label>
                                <select id="tipo" 
                                        name="tipo" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('tipo') border-red-500 @enderror"
                                        required>
                                    <option value="">Selecciona un tipo</option>
                                    <option value="venta" {{ old('tipo') === 'venta' ? 'selected' : '' }}>Venta (Productos que vendes)</option>
                                    <option value="gasto" {{ old('tipo') === 'gasto' ? 'selected' : '' }}>Gasto (Insumos que compras)</option>
                                </select>
                                @error('tipo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Precio -->
                            <div>
                                <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">
                                    Precio Unitario
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                                    <input type="number" 
                                           id="precio" 
                                           name="precio" 
                                           value="{{ old('precio') }}"
                                           step="0.01" 
                                           min="0"
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('precio') border-red-500 @enderror"
                                           placeholder="0.00"
                                           required>
                                </div>
                                @error('precio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    Para productos de venta: precio al que vendes cada unidad<br>
                                    Para productos de gasto: precio de referencia (se puede modificar al registrar gastos)
                                </p>
                            </div>

                            <!-- Foto del Producto -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto del Producto (Opcional)
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors duration-200">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                <span>Subir una foto</span>
                                                <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1">o arrastra y suelta</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                                    </div>
                                </div>
                                @error('foto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="flex space-x-4 pt-6">
                                <a href="{{ route('productos.index') }}" 
                                   class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Cancelar
                                </a>
                                <button type="submit" 
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Crear Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview de imagen
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'mx-auto h-24 w-24 object-cover rounded-md';
                    
                    const container = document.querySelector('.space-y-1.text-center');
                    const existingPreview = container.querySelector('img');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    container.insertBefore(preview, container.firstChild);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
