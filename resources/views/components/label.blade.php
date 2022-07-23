@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-dark']) }}>
    {{ $value ?? $slot }}
</label>
