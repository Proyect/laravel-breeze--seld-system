@props([
    'size' => 'md',
])

@php
    $sizes = [
        'xs' => 'h-8',
        'sm' => 'h-10',
        'md' => 'h-12',
        'lg' => 'h-16',
        'xl' => 'h-20',
    ];
    $heightClass = $sizes[$size] ?? $sizes['md'];
@endphp

<img
    src="{{ asset('media/img/logo-infrasoft.png') }}"
    alt="Infrasoft — Servicios Informáticos"
    {{ $attributes->merge(['class' => "{$heightClass} w-auto object-contain"]) }}
/>
