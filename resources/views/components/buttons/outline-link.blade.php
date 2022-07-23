@props(['type'])

<a {{ $attributes->merge(['class' => 'text-center text-base text-center py-4 px-12 bg-transparent text-'.$type.' border border-'.$type]) }}>
    {{ $slot }}
</a>
