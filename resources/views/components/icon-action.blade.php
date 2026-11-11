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
        'success' => 'from-green-400 to-blue-600 focus:ring-green-200 dark:focus:ring-green-800',
        'info' => 'from-sky-400 to-blue-600 focus:ring-sky-200 dark:focus:ring-sky-800',
        'danger' => 'from-orange-400 to-red-600 focus:ring-orange-200 dark:focus:ring-orange-800',
        'warning' => 'from-amber-400 to-orange-600 focus:ring-amber-200 dark:focus:ring-amber-800',
        'report' => 'from-purple-500 to-pink-500 focus:ring-purple-200 dark:focus:ring-purple-800',
        'neutral' => 'from-gray-400 to-gray-600 focus:ring-gray-200 dark:focus:ring-gray-700',
    ];

    $sizes = [
        'sm' => ['box' => 'h-8 w-8', 'icon' => 'text-xs'],
        'md' => ['box' => 'h-9 w-9', 'icon' => 'text-sm'],
    ];

    $gradient = $variants[$variant] ?? $variants['success'];
    $dimensions = $sizes[$size] ?? $sizes['sm'];

    $buttonClasses = 'group relative inline-flex items-center justify-center rounded-lg bg-gradient-to-br p-0.5 transition '
        .$gradient.' focus:outline-none focus:ring-4 disabled:cursor-not-allowed disabled:opacity-50';
    $iconClasses = 'inline-flex items-center justify-center rounded-md bg-white text-gray-700 group-hover:bg-transparent '
        .'group-hover:text-white dark:bg-gray-900 dark:text-gray-200 '.$dimensions['box'];
@endphp

@if ($href)
    <a href="{{ $href }}" title="{{ $label }}" aria-label="{{ $label }}"
        @if ($target) target="{{ $target }}" rel="noopener noreferrer" @endif
        {{ $attributes->merge(['class' => $buttonClasses]) }}>
        <span class="{{ $iconClasses }}">
            <i class="{{ $icon }} {{ $dimensions['icon'] }}" aria-hidden="true"></i>
        </span>
    </a>
@else
    <button type="{{ $type }}" title="{{ $label }}" aria-label="{{ $label }}"
        {{ $attributes->merge(['class' => $buttonClasses]) }}>
        <span class="{{ $iconClasses }}">
            <i class="{{ $icon }} {{ $dimensions['icon'] }}" aria-hidden="true"></i>
        </span>
    </button>
@endif
