<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Nombre') }}
                </label>
                <input id="name" name="name" type="text" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                       placeholder="Ingresa tu nombre completo" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="nombre_negocio" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <span class="mr-2">🏪</span>
                        {{ __('Nombre del Negocio') }}
                    </span>
                </label>
                <input id="nombre_negocio" name="nombre_negocio" type="text" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       value="{{ old('nombre_negocio', $user->nombre_negocio) }}" 
                       placeholder="Ej: Mi Ángel, Juguería del Sol, etc." />
                <p class="mt-1 text-xs text-gray-500">Este nombre aparecerá como título principal en todas las páginas</p>
                <x-input-error class="mt-2" :messages="$errors->get('nombre_negocio')" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Correo Electrónico') }}
                </label>
                <input id="email" name="email" type="email" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username" 
                       placeholder="tu@email.com" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
                        <p class="text-sm text-yellow-800">
                            {{ __('Tu dirección de correo no está verificada.') }}
                            <button form="send-verification" class="ml-2 underline text-green-600 hover:text-green-800 font-medium">
                                {{ __('Reenviar email de verificación') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <label for="slogan" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <span class="mr-2">💬</span>
                        {{ __('Eslogan de la Juguería') }}
                    </span>
                </label>
                <input id="slogan" name="slogan" type="text" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       value="{{ old('slogan', $user->slogan) }}" 
                       placeholder="Ej: Juguería & Smoothies, Frescura Natural, etc." />
                <p class="mt-1 text-xs text-gray-500">Este eslogan aparecerá debajo del nombre "Mi Ángel" en todas las páginas</p>
                <x-input-error class="mt-2" :messages="$errors->get('slogan')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('Guardar') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center text-sm text-green-600 font-medium"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('¡Guardado exitosamente!') }}
                </div>
            @endif
        </div>
    </form>
</section>
