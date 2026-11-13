@props([
    'icon',
    'label',
    'variant' => 'success',
    'href' => null,
    'type' => 'button',
    'target' => null,
    'size' => 'sm',
])

@php
    // Paleta única para todas las acciones del sistema (botones de icono)
    $variants = [
        'success' => 'btn-success',
        'info' => 'btn-info',
        'view' => 'btn-view',
        'danger' => 'btn-danger',
        'warning' => 'btn-warning',
        'report' => 'btn-report',
        'report-normal' => 'btn-report-normal',
        'report-special' => 'btn-report-special',
        'report-request' => 'btn-report-request',
        'export-pdf' => 'btn-export-pdf',
        'export-csv' => 'btn-export-csv',
        'neutral' => 'btn-neutral',
    ];

    $sizes = [
        'sm' => '',
        'md' => 'btn-icon-md',
    ];

    $color = $variants[$variant] ?? $variants['neutral'];
    $dimensions = $sizes[$size] ?? $sizes['sm'];

    $buttonClasses = 'btn-icon group '.$color.' '.$dimensions;
@endphp

@if ($href)
    <a href="{{ $href }}" title="{{ $label }}" aria-label="{{ $label }}"
        @if ($target) target="{{ $target }}" rel="noopener noreferrer" @endif
        {{ $attributes->merge(['class' => $buttonClasses]) }}>
        <span class="btn-outline-interior"><i class="{{ $icon }}" aria-hidden="true"></i></span>
    </a>
@else
    <button type="{{ $type }}" title="{{ $label }}" aria-label="{{ $label }}"
        {{ $attributes->merge(['class' => $buttonClasses]) }}>
        <span class="btn-outline-interior"><i class="{{ $icon }}" aria-hidden="true"></i></span>
    </button>
@endif
