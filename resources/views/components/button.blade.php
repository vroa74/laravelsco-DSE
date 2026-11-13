<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-base btn-success']) }}>
    {{ $slot }}
</button>
