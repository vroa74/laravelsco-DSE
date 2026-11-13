@props(['variant' => 'success'])

@php
    $allowed = ['success', 'info', 'view', 'danger', 'warning', 'report', 'report-normal', 'report-special', 'report-request', 'export-pdf', 'export-csv', 'neutral'];
    $color = in_array($variant, $allowed, true) ? $variant : 'success';
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-base group btn-'.$color]) }}>
    <span class="btn-outline-interior">{{ $slot }}</span>
</button>
