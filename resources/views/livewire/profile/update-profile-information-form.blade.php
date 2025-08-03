<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        <div class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" id="photo" class="hidden"
                        wire:model.live="photo" />

            <x-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2">
                @if(auth()->user()->profile_photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" 
                         alt="{{ auth()->user()->name }}" 
                         class="rounded-full size-20 object-cover">
                @else
                    <div class="size-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-2xl">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                @endif
            </div>

            <!-- New Profile Photo Preview -->
            @if($photo)
                <div class="mt-2">
                    <img src="{{ $photo->temporaryUrl() }}" 
                         alt="Vista previa" 
                         class="rounded-full size-20 object-cover">
                    <p class="text-xs text-green-600 mt-1">Archivo seleccionado: {{ $photo->getClientOriginalName() }}</p>
                </div>
            @endif

            <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-secondary-button>

            @if (auth()->user()->profile_photo_path)
                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </x-secondary-button>
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section> 