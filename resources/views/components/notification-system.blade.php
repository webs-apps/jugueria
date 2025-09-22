<!-- Sistema de Notificaciones Brutal y Hermoso -->
<div id="notification-container" class="fixed top-4 right-4 z-50 space-y-3 max-w-sm w-full">
    <!-- Las notificaciones se insertarán aquí dinámicamente -->
</div>

<!-- Estilos para las notificaciones -->
<style>
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% {
            transform: translate3d(0,0,0);
        }
        40%, 43% {
            transform: translate3d(0, -8px, 0);
        }
        70% {
            transform: translate3d(0, -4px, 0);
        }
        90% {
            transform: translate3d(0, -2px, 0);
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -200px 0;
        }
        100% {
            background-position: calc(200px + 100%) 0;
        }
    }

    .notification-enter {
        animation: slideInRight 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .notification-exit {
        animation: slideOutRight 0.3s ease-in-out;
    }

    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200px 100%;
        animation: shimmer 1.5s infinite;
    }

    .notification-glow {
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.3), 0 0 40px rgba(34, 197, 94, 0.1);
    }

    .notification-glow-error {
        box-shadow: 0 0 20px rgba(239, 68, 68, 0.3), 0 0 40px rgba(239, 68, 68, 0.1);
    }

    .notification-glow-warning {
        box-shadow: 0 0 20px rgba(245, 158, 11, 0.3), 0 0 40px rgba(245, 158, 11, 0.1);
    }
</style>

<!-- JavaScript para el sistema de notificaciones -->
<script>
class NotificationSystem {
    constructor() {
        this.container = document.getElementById('notification-container');
        this.notifications = new Map();
    }

    // Mostrar notificación de carga
    showLoading(message = 'Procesando...', id = null) {
        const notificationId = id || 'loading-' + Date.now();
        
        const notification = document.createElement('div');
        notification.id = notificationId;
        notification.className = 'notification-enter bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl border border-green-200/50 p-6 notification-glow';
        
        notification.innerHTML = `
            <div class="flex items-center space-x-4">
                <!-- Spinner de carga brutal -->
                <div class="relative">
                    <div class="w-12 h-12 border-4 border-green-200 rounded-full animate-spin border-t-green-500"></div>
                    <div class="absolute inset-0 w-12 h-12 border-4 border-transparent rounded-full animate-pulse border-t-emerald-400"></div>
                </div>
                
                <!-- Contenido -->
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-teal-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                    <p class="text-gray-800 font-semibold text-lg">${message}</p>
                    <div class="mt-2">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-emerald-600 rounded-full animate-pulse loading-shimmer"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        this.container.appendChild(notification);
        this.notifications.set(notificationId, notification);
        
        return notificationId;
    }

    // Mostrar notificación de éxito
    showSuccess(message, title = '¡Éxito!', duration = 4000) {
        const notificationId = 'success-' + Date.now();
        
        const notification = document.createElement('div');
        notification.id = notificationId;
        notification.className = 'notification-enter bg-gradient-to-br from-green-50 to-emerald-50 backdrop-blur-md rounded-3xl shadow-2xl border border-green-200/50 p-6 notification-glow';
        
        notification.innerHTML = `
            <div class="flex items-center space-x-4">
                <!-- Icono de éxito con animación -->
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center animate-bounce">
                        <svg class="w-6 h-6 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <!-- Efecto de ondas -->
                    <div class="absolute inset-0 w-12 h-12 bg-green-400 rounded-full animate-ping opacity-20"></div>
                </div>
                
                <!-- Contenido -->
                <div class="flex-1">
                    <h4 class="text-green-800 font-bold text-lg mb-1">${title}</h4>
                    <p class="text-green-700 font-medium">${message}</p>
                </div>
                
                <!-- Botón de cerrar -->
                <button onclick="notificationSystem.hide('${notificationId}')" 
                        class="text-green-600 hover:text-green-800 transition-colors p-1 rounded-full hover:bg-green-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        this.container.appendChild(notification);
        this.notifications.set(notificationId, notification);
        
        // Auto-ocultar después del tiempo especificado
        setTimeout(() => {
            this.hide(notificationId);
        }, duration);
        
        return notificationId;
    }

    // Mostrar notificación de error
    showError(message, title = '¡Error!', duration = 6000) {
        const notificationId = 'error-' + Date.now();
        
        const notification = document.createElement('div');
        notification.id = notificationId;
        notification.className = 'notification-enter bg-gradient-to-br from-red-50 to-pink-50 backdrop-blur-md rounded-3xl shadow-2xl border border-red-200/50 p-6 notification-glow-error';
        
        notification.innerHTML = `
            <div class="flex items-center space-x-4">
                <!-- Icono de error con animación -->
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center animate-pulse">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <!-- Efecto de ondas -->
                    <div class="absolute inset-0 w-12 h-12 bg-red-400 rounded-full animate-ping opacity-20"></div>
                </div>
                
                <!-- Contenido -->
                <div class="flex-1">
                    <h4 class="text-red-800 font-bold text-lg mb-1">${title}</h4>
                    <p class="text-red-700 font-medium">${message}</p>
                </div>
                
                <!-- Botón de cerrar -->
                <button onclick="notificationSystem.hide('${notificationId}')" 
                        class="text-red-600 hover:text-red-800 transition-colors p-1 rounded-full hover:bg-red-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        this.container.appendChild(notification);
        this.notifications.set(notificationId, notification);
        
        // Auto-ocultar después del tiempo especificado
        setTimeout(() => {
            this.hide(notificationId);
        }, duration);
        
        return notificationId;
    }

    // Mostrar notificación de advertencia
    showWarning(message, title = '¡Atención!', duration = 5000) {
        const notificationId = 'warning-' + Date.now();
        
        const notification = document.createElement('div');
        notification.id = notificationId;
        notification.className = 'notification-enter bg-gradient-to-br from-yellow-50 to-orange-50 backdrop-blur-md rounded-3xl shadow-2xl border border-yellow-200/50 p-6 notification-glow-warning';
        
        notification.innerHTML = `
            <div class="flex items-center space-x-4">
                <!-- Icono de advertencia con animación -->
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center animate-bounce">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <!-- Efecto de ondas -->
                    <div class="absolute inset-0 w-12 h-12 bg-yellow-400 rounded-full animate-ping opacity-20"></div>
                </div>
                
                <!-- Contenido -->
                <div class="flex-1">
                    <h4 class="text-yellow-800 font-bold text-lg mb-1">${title}</h4>
                    <p class="text-yellow-700 font-medium">${message}</p>
                </div>
                
                <!-- Botón de cerrar -->
                <button onclick="notificationSystem.hide('${notificationId}')" 
                        class="text-yellow-600 hover:text-yellow-800 transition-colors p-1 rounded-full hover:bg-yellow-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        this.container.appendChild(notification);
        this.notifications.set(notificationId, notification);
        
        // Auto-ocultar después del tiempo especificado
        setTimeout(() => {
            this.hide(notificationId);
        }, duration);
        
        return notificationId;
    }

    // Ocultar notificación
    hide(notificationId) {
        const notification = this.notifications.get(notificationId);
        if (notification) {
            notification.classList.add('notification-exit');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
                this.notifications.delete(notificationId);
            }, 300);
        }
    }

    // Ocultar todas las notificaciones
    hideAll() {
        this.notifications.forEach((notification, id) => {
            this.hide(id);
        });
    }

    // Actualizar notificación de carga a éxito/error
    updateLoading(loadingId, type, message, title = null) {
        const loadingNotification = this.notifications.get(loadingId);
        if (loadingNotification) {
            this.hide(loadingId);
            
            setTimeout(() => {
                if (type === 'success') {
                    this.showSuccess(message, title || '¡Éxito!');
                } else if (type === 'error') {
                    this.showError(message, title || '¡Error!');
                } else if (type === 'warning') {
                    this.showWarning(message, title || '¡Atención!');
                }
            }, 100);
        }
    }
}

// Crear instancia global
const notificationSystem = new NotificationSystem();

// Función helper para mostrar notificaciones rápidamente
function showNotification(type, message, title = null, duration = null) {
    switch(type) {
        case 'loading':
            return notificationSystem.showLoading(message);
        case 'success':
            return notificationSystem.showSuccess(message, title, duration);
        case 'error':
            return notificationSystem.showError(message, title, duration);
        case 'warning':
            return notificationSystem.showWarning(message, title, duration);
        default:
            return notificationSystem.showSuccess(message, title, duration);
    }
}
</script>
