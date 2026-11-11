<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 flex flex-wrap items-center justify-end gap-2">
                <x-icon-action variant="neutral" icon="fa-solid fa-house" label="Ir al inicio" size="md"
                    :href="url('/')" />

                <x-icon-action variant="success" icon="fa-solid fa-paper-plane" label="Enviar enlace de restablecimiento"
                    size="md" type="submit" />
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
