@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-brand-yellow font-bold text-sm leading-5 text-white focus:outline-none transition duration-150 ease-in-out tracking-wide'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-blue-200 hover:text-white hover:border-blue-400 focus:outline-none transition duration-150 ease-in-out tracking-wide';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
