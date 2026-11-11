<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4" x-data="{ show: false }">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password"
                        x-bind:type="show ? 'text' : 'password'" required autocomplete="new-password" />
                    <x-password-toggle-button />
                </div>
            </div>

            <div class="mt-4" x-data="{ show: false }">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <x-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password"
                        name="password_confirmation" x-bind:type="show ? 'text' : 'password'" required
                        autocomplete="new-password" />
                    <x-password-toggle-button />
                </div>
            </div>

            <div class="mt-4 flex items-center justify-end gap-2">
                <x-icon-action variant="success" icon="fa-solid fa-floppy-disk" label="Restablecer contraseña"
                    size="md" type="submit" />
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
