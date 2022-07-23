@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-light shadow-sm border-0 border-b border-dark focus:border-lightAccent focus:ring-0 focus:ring-transparent focus:ring-opacity-0']) !!}>
