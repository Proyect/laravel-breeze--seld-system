@extends('layouts.landing-tailwind')

@section('title', $servicio['nombre'] . ' | Infrasoft')

@push('head')
    <meta name="keywords" content="{{ implode(', ', $servicio['tecnologias'] ?? []) }}, {{ $servicio['nombre'] }}, desarrollo, software, infrasoft">
    <meta name="description" content="{{ $servicio['descripcion_larga'] }}">
@endpush

@section('container')
<section class="servicios-container">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Título del servicio -->
        <h1 class="servicio-titulo">{{ $servicio['nombre'] }}</h1>
        
        <!-- Descripción del servicio -->
        <p class="servicio-descripcion">{{ $servicio['descripcion_larga'] }}</p>
        
        <!-- Sección de Tecnologías -->
        @if(isset($servicio['tecnologias']) && count($servicio['tecnologias']) > 0)
        <div class="tecnologias-seccion">
            <h2 class="tecnologias-titulo">Tecnologías que utilizamos</h2>
            <p class="tecnologias-descripcion">
                Trabajamos con las mejores tecnologías del mercado para garantizar la calidad y eficiencia de nuestros servicios:
            </p>
            <div class="tecnologias-grid">
                @foreach($servicio['tecnologias'] as $tecnologia)
                <div class="tecnologia-tarjeta" data-tecnologia="{{ $tecnologia }}">
                    <span class="tecnologia-nombre">{{ $tecnologia }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Formulario de relevamiento -->
        @include('servicios.form-relevamiento', ['slug' => $slug])
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Configuración específica para esta página
    document.addEventListener('DOMContentLoaded', function() {
        // Log de tecnologías disponibles para debugging
        const tecnologias = @json($servicio['tecnologias'] ?? []);
        console.log('Tecnologías disponibles:', tecnologias);
        
        // Agregar atributos de datos para analytics
        document.querySelectorAll('.tecnologia-tarjeta').forEach(card => {
            card.setAttribute('data-category', '{{ $servicio["nombre"] }}');
            card.setAttribute('data-service', '{{ $slug }}');
        });
    });
</script>
@endpush 