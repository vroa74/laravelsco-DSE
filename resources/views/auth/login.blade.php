<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="rfc" value="{{ __('RFC') }}" />
                <div class="relative">
                    <x-input id="rfc" class="block mt-1 w-full pr-10" type="password" name="rfc" :value="old('rfc')" required autocomplete="off" maxlength="13" placeholder="Ingrese su RFC" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center password-toggle-btn" onclick="togglePasswordVisibility('rfc')">
                        <svg id="rfc-eye" class="w-5 h-5 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="current-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center password-toggle-btn" onclick="togglePasswordVisibility('password')">
                        <svg id="password-eye" class="w-5 h-5 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <!-- Mostrar el tiempo de inactividad -->
        <div id="inactive-time" class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            Tiempo sin actividad: <span id="time-counter">0</span> segundos
        </div>
    </x-authentication-card>

    <!-- Estilos para los botones de ojo -->
    <style>
        .password-toggle-btn {
            transition: all 0.2s ease-in-out;
            z-index: 10;
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
        }
        
        .password-toggle-btn:hover {
            transform: scale(1.1);
        }
        
        .password-toggle-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        .password-toggle-btn svg {
            width: 20px;
            height: 20px;
            display: block;
        }

        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .inset-y-0 {
            top: 0;
            bottom: 0;
        }

        .right-0 {
            right: 0;
        }

        .pr-3 {
            padding-right: 0.75rem;
        }

        .pr-10 {
            padding-right: 2.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }
    </style>

    <!-- Script para manejar la inactividad -->
    <script>
        let timeout;
        let secondsInactive = 0;

        const updateInactiveTime = () => {
            const counter = document.getElementById("time-counter");
            counter.textContent = secondsInactive; // Actualiza el tiempo en segundos
        };

        const redirectToHome = () => {
            window.location.href = "{{ url('/') }}"; // Redirige a la página principal
        };

        const resetTimer = () => {
            secondsInactive = 0; // Reinicia el contador
            updateInactiveTime();
            clearTimeout(timeout);
            timeout = setTimeout(redirectToHome, 60000); // Redirige tras 1 minuto de inactividad
        };

        const incrementInactiveTime = () => {
            secondsInactive++;
            updateInactiveTime();
        };

        // Eventos para detectar actividad
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.ontouchstart = resetTimer;

        // Incrementar el tiempo inactivo cada segundo
        setInterval(incrementInactiveTime, 1000);

        // El RFC ahora acepta mayúsculas y minúsculas

        // Función para mostrar/ocultar contraseña
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                // Cambiar a icono de ojo tachado
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
                eyeIcon.title = 'Ocultar ' + (fieldId === 'rfc' ? 'RFC' : 'contraseña');
            } else {
                field.type = 'password';
                // Cambiar a icono de ojo normal
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
                eyeIcon.title = 'Mostrar ' + (fieldId === 'rfc' ? 'RFC' : 'contraseña');
            }
        }

        // Inicializar tooltips para los botones de ojo
        document.addEventListener('DOMContentLoaded', function() {
            const rfcEye = document.getElementById('rfc-eye');
            const passwordEye = document.getElementById('password-eye');
            
            if (rfcEye) rfcEye.title = 'Mostrar RFC';
            if (passwordEye) passwordEye.title = 'Mostrar contraseña';
        });
    </script>
</x-guest-layout>
