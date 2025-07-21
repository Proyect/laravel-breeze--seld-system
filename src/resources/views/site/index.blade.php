@extends('layouts.landing-tailwind')

@section('title', 'Infrasoft | Servicios Informáticos')
@section('meta_description', 'Desarrollo de software, Data Science, Seguridad Informática, SaaS y más.')

@section('container')
    <!-- Hero principal -->
    <section class="bg-gradient-to-r from-blue-700 to-blue-400 text-white py-20 mb-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Soluciones Informáticas para tu Negocio</h1>
            <p class="text-lg md:text-2xl mb-8">Desarrollo de Software · Data Science · Seguridad Informática · SaaS</p>
            <a href="#contacto" class="inline-block px-8 py-3 bg-white text-blue-700 font-semibold rounded shadow hover:bg-blue-100 transition">Solicita tu presupuesto</a>
        </div>
    </section>

    <!-- Servicios destacados -->
    <section id="servicios" class="container mx-auto px-4 mb-16">
        <h2 class="text-3xl font-bold text-center mb-10 text-blue-700">Nuestros Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @component('components.service-card', [
                'title' => 'Desarrollo de Software',
                'description' => 'Creamos sistemas a medida, robustos y escalables para empresas y emprendedores.',
                'icon' => '<svg class="w-12 h-12 mx-auto text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>',
            ])@endcomponent
            @component('components.service-card', [
                'title' => 'Data Science',
                'description' => 'Analítica avanzada, dashboards y modelos predictivos para potenciar tu negocio.',
                'icon' => '<svg class="w-12 h-12 mx-auto text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 17a4 4 0 01-4-4V7a4 4 0 018 0v6a4 4 0 01-4 4zm0 0v2m0 0h2m-2 0H9" /></svg>',
            ])@endcomponent
            @component('components.service-card', [
                'title' => 'Seguridad Informática',
                'description' => 'Protege tus datos y sistemas con auditorías, consultoría y soluciones de ciberseguridad.',
                'icon' => '<svg class="w-12 h-12 mx-auto text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2zm0 0V7m0 4v4m0 0h4m-4 0H8" /></svg>',
            ])@endcomponent
            @component('components.service-card', [
                'title' => 'SaaS y Soluciones en la Nube',
                'description' => 'Implementación y venta de servicios SaaS para digitalizar y escalar tu empresa.',
                'icon' => '<svg class="w-12 h-12 mx-auto text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 100-8h-1.26A8 8 0 103 15z" /></svg>',
            ])@endcomponent
        </div>
    </section>

    <!-- Ventajas -->
    <section id="ventajas" class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8 text-blue-700">¿Por qué elegirnos?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Experiencia</h3>
                    <p>Más de 10 años desarrollando soluciones para empresas de todo el país y el mundo.</p>
                </div>
                <div class="p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Soporte Personalizado</h3>
                    <p>Acompañamiento y asesoría en cada etapa de tu proyecto, desde la idea hasta la implementación.</p>
                </div>
                <div class="p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Innovación</h3>
                    <p>Aplicamos las últimas tecnologías y metodologías para que tu negocio crezca seguro y escalable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="bg-blue-50 py-16">
        <div class="container mx-auto px-4 max-w-2xl">
            <h2 class="text-2xl font-bold text-center mb-8 text-blue-700">Contacto rápido</h2>
            <form method="POST" action="{{ route('contact.submit') }}" class="bg-white rounded-lg shadow p-8 space-y-6">
                @csrf
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    <label class="block mb-1 font-medium">Nombre</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Tu nombre" required value="{{ old('name') }}">
                </div>
                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="tu@email.com" required value="{{ old('email') }}">
                </div>
                <div>
                    <label class="block mb-1 font-medium">Mensaje</label>
                    <textarea name="message" class="w-full border border-gray-300 rounded px-3 py-2" rows="4" placeholder="¿En qué podemos ayudarte?" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition">Enviar consulta</button>
            </form>
        </div>
    </section>
@endsection