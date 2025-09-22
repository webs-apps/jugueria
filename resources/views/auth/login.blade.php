<x-guest-layout>
    <!-- Header del formulario -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <span class="text-white text-2xl">🔐</span>
            </div>
            <h2 class="text-2xl font-bold text-white">Iniciar Sesión</h2>
            <p class="text-green-100 text-sm mt-1">Accede a tu cuenta de Mi Ángel</p>
        </div>
    </div>

    <!-- Contenido del formulario -->
    <div class="p-8">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <span class="flex items-center">
                        <span class="mr-2">📧</span>
                        Correo Electrónico
                    </span>
                </label>
                <div class="relative">
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white shadow-sm"
                           placeholder="tu@email.com">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-gray-400">📧</span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <span class="flex items-center">
                        <span class="mr-2">🔒</span>
                        Contraseña
                    </span>
                </label>
                <div class="relative">
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white shadow-sm"
                           placeholder="••••••••">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-gray-400">🔒</span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500 focus:ring-offset-0" 
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-green-600 hover:text-green-700 font-medium transition-colors duration-200" 
                       href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 px-6 rounded-2xl font-semibold shadow-lg hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                    <span class="flex items-center justify-center">
                        <span class="mr-2">🚀</span>
                        Iniciar Sesión
                    </span>
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
