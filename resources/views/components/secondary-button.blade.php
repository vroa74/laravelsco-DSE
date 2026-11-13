<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-base btn-neutral']) }}>
    {{ $slot }}
</button>
