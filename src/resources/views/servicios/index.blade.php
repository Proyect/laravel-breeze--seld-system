@extends('layouts.landing-tailwind')

@section('title', 'Servicios | Infrasoft')

@push('head')
    <meta name="keywords" content="servicios, desarrollo, software, data science, seguridad, cloud, infrasoft">
    <meta name="description" content="Descubra todos nuestros servicios de desarrollo de software, data science, seguridad informática y soluciones en la nube.">
@endpush

@section('container')
{{-- Hero --}}
<section class="py-16 bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-800 text-white">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Nuestros Servicios</h1>
        <p class="text-xl text-blue-100 leading-relaxed">
            Soluciones tecnológicas integrales para potenciar su negocio. Desde el desarrollo de software a medida hasta la migración a la nube, con un equipo experto a su disposición.
        </p>
    </div>
</section>

<section class="servicios-container py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($servicios as $slug => $servicio)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col">
                <div class="p-8 border-b border-gray-100 flex-1">
                    <div class="flex items-center mb-4">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center mr-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $servicio['nombre'] }}</h2>
                            @if(isset($servicio['categoria']))
                            <span class="inline-block px-2 py-0.5 text-xs font-medium text-blue-600 bg-blue-50 rounded-full mt-1">{{ ucfirst($servicio['categoria']) }}</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">{{ $servicio['descripcion_corta'] ?? Str::limit($servicio['descripcion_larga'], 150) }}</p>

                    @if(isset($servicio['beneficios']) && count($servicio['beneficios']) > 0)
                    <ul class="space-y-2 mb-4">
                        @foreach(array_slice($servicio['beneficios'], 0, 3) as $beneficio)
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $beneficio }}
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    @if(isset($servicio['tecnologias']) && count($servicio['tecnologias']) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice($servicio['tecnologias'], 0, 5) as $tecnologia)
                        <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">{{ $tecnologia }}</span>
                        @endforeach
                        @if(count($servicio['tecnologias']) > 5)
                        <span class="px-2 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded-full">+{{ count($servicio['tecnologias']) - 5 }}</span>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="p-6 bg-gray-50">
                    <a href="{{ route('servicios.detalle', $slug) }}"
                       class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                        Ver detalle completo
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Por qué elegirnos --}}
        <div class="mt-16 bg-white rounded-2xl shadow-lg p-8 md:p-12 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">¿Por qué contratar servicios con Infrasoft?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-blue-600 mb-2">10+</div>
                    <p class="text-gray-600">Años de experiencia en el mercado</p>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-600 mb-2">150+</div>
                    <p class="text-gray-600">Proyectos entregados exitosamente</p>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-600 mb-2">24h</div>
                    <p class="text-gray-600">Tiempo de respuesta garantizado</p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-16">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 md:p-12 text-white">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">¿Necesita algo específico?</h2>
                <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                    Si no encuentra exactamente lo que busca, contáctenos. Creamos soluciones personalizadas adaptadas a las necesidades únicas de su empresa.
                </p>
                <a href="/#contacto" class="inline-flex items-center px-8 py-3 text-base font-semibold text-blue-600 bg-white rounded-lg hover:bg-gray-50 transition">
                    Solicitar consultoría gratuita
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
