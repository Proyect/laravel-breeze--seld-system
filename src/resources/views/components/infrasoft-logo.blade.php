@props([
    'size' => 'md',
    'variant' => 'full',
])

@php
    $variants = [
        'full' => [
            'src' => 'media/img/logo-infrasoft.png',
            'class' => match ($size) {
                'xs' => 'h-8 w-auto',
                'sm' => 'h-10 w-auto',
                'md' => 'h-14 w-auto',
                'lg' => 'h-20 w-auto',
                'xl' => 'h-24 w-auto',
                default => 'h-14 w-auto',
            },
        ],
        'header' => [
            'src' => 'media/img/logo-infrasoft-header.png',
            'class' => 'h-10 sm:h-11 md:h-12 lg:h-14 w-auto max-w-[200px] sm:max-w-[240px] md:max-w-[280px] lg:max-w-[320px]',
        ],
        'nav' => [
            'src' => 'media/img/logo-infrasoft-header.png',
            'class' => 'h-9 sm:h-10 w-auto max-w-[180px]',
        ],
    ];

    $config = $variants[$variant] ?? $variants['full'];
@endphp

<img
    src="{{ asset($config['src']) }}"
    alt="Infrasoft — Servicios Informáticos"
    {{ $attributes->merge(['class' => $config['class'] . ' object-contain object-left']) }}
/>
