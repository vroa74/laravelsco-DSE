@props(['id' => null, 'maxWidth' => null])

@php
    $dialogId = $id ?? 'dialog-'.md5($attributes->wire('model'));
    $titleId = $dialogId.'-title';
@endphp

<x-modal :id="$dialogId" :maxWidth="$maxWidth" :labelledby="$titleId" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="flex items-center justify-between gap-4 border-b border-primary pb-3">
            <h2 id="{{ $titleId }}" class="text-lg font-medium text-primary">{{ $title }}</h2>
            <button type="button" class="modal-close" aria-label="Cerrar diálogo" x-on:click="$dispatch('close')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m6 6 12 12M6 18 18 6" />
                </svg>
            </button>
        </div>

        <div class="mt-4 text-sm text-secondary">
            {{ $content }}
        </div>
    </div>

    <div class="modal-actions px-6 py-4 border-t border-primary text-end">
        {{ $footer }}
    </div>
</x-modal>
