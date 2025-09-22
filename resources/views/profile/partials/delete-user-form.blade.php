<section class="space-y-6">
    <div class="p-6 bg-red-50 border border-red-200 rounded-2xl">
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-medium text-red-800 mb-2">
                    {{ __('Eliminar Cuenta Permanentemente') }}
                </h3>
                <p class="text-sm text-red-700 mb-4">
                    {{ __('Una vez que elimines tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.') }}
                </p>
                <button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-orange-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-red-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    {{ __('Eliminar Cuenta') }}
                </button>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-8">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-white text-xl">⚠️</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('¿Estás seguro?') }}
                    </h2>
                    <p class="text-sm text-gray-600">Esta acción no se puede deshacer</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div class="p-6 bg-red-50 border border-red-200 rounded-2xl">
                    <p class="text-sm text-red-800">
                        {{ __('Una vez que elimines tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Por favor, ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.') }}
                    </p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Contraseña') }}
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                        placeholder="{{ __('Ingresa tu contraseña para confirmar') }}"
                        required
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" 
                            x-on:click="$dispatch('close')"
                            class="px-6 py-3 border border-gray-300 rounded-2xl font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        {{ __('Cancelar') }}
                    </button>

                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-orange-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-widest hover:from-red-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        {{ __('Eliminar Cuenta') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
