<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <x-icon-action variant="success" icon="fa-solid fa-paper-plane"
                    label="Reenviar correo de verificación" size="md" type="submit" />
            </form>

            <div class="flex items-center gap-2">
                <x-icon-action variant="info" icon="fa-solid fa-user-pen" label="Editar perfil" size="md"
                    :href="route('profile.show')" />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-icon-action variant="danger" icon="fa-solid fa-right-from-bracket" label="Cerrar sesión"
                        size="md" type="submit" />
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
