<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-base btn-danger']) }}>
    {{ $slot }}
</button>
