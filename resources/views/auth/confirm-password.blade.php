<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div x-data="{ show: false }">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password"
                        x-bind:type="show ? 'text' : 'password'" required autocomplete="current-password" autofocus />
                    <x-password-toggle-button />
                </div>
            </div>

            <div class="mt-4 flex items-center justify-end gap-2">
                <x-icon-action variant="success" icon="fa-solid fa-check" label="Confirmar contraseña"
                    size="md" type="submit" />
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
