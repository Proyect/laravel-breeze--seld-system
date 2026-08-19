@extends('layouts.landing-tailwind')

@section('title', $articulo['titulo'] . ' | Infrasoft')

@push('head')
    <meta name="description" content="{{ $articulo['resumen'] }}">
@endpush

@section('container')
@php
    $colorMap = [
        'blue' => 'bg-blue-100 text-blue-800',
        'red' => 'bg-red-100 text-red-800',
        'cyan' => 'bg-cyan-100 text-cyan-800',
        'purple' => 'bg-purple-100 text-purple-800',
        'green' => 'bg-green-100 text-green-800',
        'amber' => 'bg-amber-100 text-amber-800',
    ];
    $badgeClass = $colorMap[$articulo['color']] ?? $colorMap['blue'];
@endphp
<section class="py-12 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container mx-auto px-4 max-w-3xl">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="/" class="hover:text-blue-600">Inicio</a>
            <span class="mx-2">/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-blue-600">Blog</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $articulo['categoria'] }}</span>
        </nav>

        <article class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 {{ $badgeClass }} rounded-full text-sm font-semibold">{{ $articulo['categoria'] }}</span>
                <time class="text-gray-500 text-sm">{{ $articulo['fecha'] }}</time>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 leading-tight">{{ $articulo['titulo'] }}</h1>

            <div class="prose prose-lg max-w-none text-gray-700 space-y-5">
                @foreach($articulo['contenido'] as $parrafo)
                <p class="leading-relaxed">{{ $parrafo }}</p>
                @endforeach
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-wrap gap-4">
                <a href="{{ route('blog.index') }}" class="text-blue-600 font-semibold hover:text-blue-800 transition">← Volver al blog</a>
                <a href="/#contacto" class="text-gray-600 font-semibold hover:text-gray-900 transition">Consultar con un experto</a>
            </div>
        </article>
    </div>
</section>
@endsection
