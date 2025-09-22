<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <div>
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Contraseña Actual') }}
                </label>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       autocomplete="current-password" 
                       placeholder="Ingresa tu contraseña actual" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Nueva Contraseña') }}
                </label>
                <input id="update_password_password" name="password" type="password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       autocomplete="new-password" 
                       placeholder="Ingresa tu nueva contraseña" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Confirmar Contraseña') }}
                </label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       autocomplete="new-password" 
                       placeholder="Confirma tu nueva contraseña" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                {{ __('Actualizar Contraseña') }}
            </button>

            @if (session('status') === 'password-updated')
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
                    {{ __('¡Contraseña actualizada exitosamente!') }}
                </div>
            @endif
        </div>
    </form>
</section>
