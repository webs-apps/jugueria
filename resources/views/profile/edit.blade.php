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
                        <h1 class="text-xl font-bold text-gray-900">Mi Ángel</h1>
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
                        <a href="{{ route('configuracion.edit') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg transform hover:scale-105">
                            <span class="mr-2 text-lg">⚙️</span>{{ __('Configuración') }}
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
