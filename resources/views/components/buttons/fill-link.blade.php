@props(['type'])

<a {{ $attributes->merge(['class' => 'text-center text-base text-light text-center py-4 px-12 bg-'.$type]) }}>
    {{ $slot }}
</a>
