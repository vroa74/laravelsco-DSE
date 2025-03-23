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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
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
    </script>
</x-guest-layout>
