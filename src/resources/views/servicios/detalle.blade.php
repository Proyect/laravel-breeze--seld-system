@extends('layouts.landing-tailwind')

@section('title', $servicio['nombre'] . ' | Infrasoft')

@push('head')
    <meta name="keywords" content="{{ implode(', ', $servicio['tecnologias'] ?? []) }}, {{ $servicio['nombre'] }}, desarrollo, software, infrasoft">
    <meta name="description" content="{{ $servicio['descripcion_larga'] ?? $servicio['descripcion_corta'] ?? '' }}">
@endpush

@section('container')
<section class="py-12 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container mx-auto px-4 max-w-5xl">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="/" class="hover:text-blue-600">Inicio</a>
            <span class="mx-2">/</span>
            <a href="/servicios" class="hover:text-blue-600">Servicios</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $servicio['nombre'] }}</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12">
            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">{{ ucfirst($servicio['categoria'] ?? 'Servicio') }}</span>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $servicio['nombre'] }}</h1>
            <p class="text-xl text-gray-600 leading-relaxed">{{ $servicio['descripcion_larga'] }}</p>
        </div>

        @if(!empty($servicio['beneficios']))
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">¿Qué obtiene su empresa?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($servicio['beneficios'] as $beneficio)
                <div class="flex items-start gap-3 bg-white rounded-xl p-5 shadow border border-gray-100">
                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <p class="text-gray-700">{{ $beneficio }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(!empty($servicio['incluye']))
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">El servicio incluye</h2>
            <ul class="bg-white rounded-xl shadow border border-gray-100 divide-y divide-gray-100">
                @foreach($servicio['incluye'] as $item)
                <li class="flex items-center gap-3 px-6 py-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-gray-700">{{ $item }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($servicio['proceso']))
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Nuestro proceso</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($servicio['proceso'] as $index => $paso)
                <div class="bg-white rounded-xl p-6 shadow border border-gray-100 text-center">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold">{{ $index + 1 }}</div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $paso['titulo'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $paso['descripcion'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(isset($servicio['tecnologias']) && count($servicio['tecnologias']) > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Tecnologías que utilizamos</h2>
            <p class="text-gray-600 mb-6">Trabajamos con las mejores herramientas del mercado para garantizar calidad y eficiencia:</p>
            <div class="flex flex-wrap gap-3">
                @foreach($servicio['tecnologias'] as $tecnologia)
                <span class="px-4 py-2 bg-white border border-gray-200 rounded-full text-gray-700 font-medium text-sm shadow-sm hover:border-blue-300 hover:text-blue-700 transition">{{ $tecnologia }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-8 md:p-12 text-white text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">¿Interesado en {{ $servicio['nombre'] }}?</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Solicite un presupuesto sin compromiso. Le responderemos en menos de 24 horas con una propuesta adaptada a su necesidad.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/#contacto" class="inline-flex items-center justify-center px-8 py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-gray-100 transition">Solicitar presupuesto</a>
                <a href="/servicios" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition">Ver todos los servicios</a>
            </div>
        </div>

        @include('servicios.form-relevamiento', ['slug' => $slug])
    </div>
</section>
@endsection
