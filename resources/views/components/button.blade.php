<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center text-base text-light text-center py-4 px-12 bg-brand hover:bg-brandHover']) }}>
    {{ $slot }}
</button>
