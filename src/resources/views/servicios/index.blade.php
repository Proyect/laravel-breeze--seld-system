@extends('layouts.landing-tailwind')

@section('title', 'Servicios | Infrasoft')

@push('head')
    <meta name="keywords" content="servicios, desarrollo, software, data science, seguridad, cloud, infrasoft">
    <meta name="description" content="Descubre todos nuestros servicios de desarrollo de software, data science, seguridad informática y soluciones en la nube.">
@endpush

@section('container')
<section class="servicios-container">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Título principal -->
        <div class="text-center mb-12">
            <h1 class="servicio-titulo text-4xl">Nuestros Servicios</h1>
            <p class="servicio-descripcion text-xl max-w-3xl mx-auto">
                Ofrecemos soluciones integrales en tecnología para potenciar tu negocio y llevar tu empresa al siguiente nivel
            </p>
        </div>

        <!-- Grid de servicios -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach($servicios as $slug => $servicio)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                <!-- Header del servicio -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center mb-4">
                        @if(isset($servicio['icono']))
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mr-4">
                            <i class="{{ $servicio['icono'] }} text-white text-xl"></i>
                        </div>
                        @endif
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $servicio['nombre'] }}</h2>
                            @if(isset($servicio['categoria']))
                            <span class="inline-block px-2 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded-full">
                                {{ ucfirst($servicio['categoria']) }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed">{{ $servicio['descripcion_larga'] }}</p>
                </div>

                <!-- Tecnologías destacadas -->
                @if(isset($servicio['tecnologias']) && count($servicio['tecnologias']) > 0)
                <div class="p-6 bg-gray-50">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Tecnologías principales:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice($servicio['tecnologias'], 0, 6) as $tecnologia)
                        <span class="px-3 py-1 text-xs font-medium text-gray-600 bg-white rounded-full border border-gray-200">
                            {{ $tecnologia }}
                        </span>
                        @endforeach
                        @if(count($servicio['tecnologias']) > 6)
                        <span class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded-full">
                            +{{ count($servicio['tecnologias']) - 6 }} más
                        </span>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Footer con enlace -->
                <div class="p-6 bg-white">
                    <a href="{{ route('servicios.detalle', $slug) }}" 
                       class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Ver detalles
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA -->
        <div class="text-center mt-16">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white">
                <h2 class="text-2xl font-bold mb-4">¿Necesitas algo específico?</h2>
                <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
                    Si no encuentras exactamente lo que buscas, contáctanos. Estamos aquí para crear soluciones personalizadas que se adapten a tus necesidades específicas.
                </p>
                <a href="#contacto" class="inline-flex items-center px-6 py-3 text-base font-medium text-blue-600 bg-white rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-700 transition-colors duration-200">
                    Contactar ahora
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Agregar efectos de hover mejorados a las tarjetas
        const serviceCards = document.querySelectorAll('.bg-white.rounded-xl');
        
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Log para debugging
        console.log('Servicios disponibles:', @json($servicios));
    });
</script>
@endpush 