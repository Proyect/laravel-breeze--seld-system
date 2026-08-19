{{-- Sección: Blog / Novedades --}}
@php
    $colorMap = [
        'blue' => ['gradient' => 'from-blue-500 to-blue-700', 'badge' => 'bg-blue-100 text-blue-700', 'link' => 'text-blue-600 hover:text-blue-800'],
        'red' => ['gradient' => 'from-red-500 to-red-700', 'badge' => 'bg-red-100 text-red-700', 'link' => 'text-red-600 hover:text-red-800'],
        'cyan' => ['gradient' => 'from-cyan-500 to-cyan-700', 'badge' => 'bg-cyan-100 text-cyan-700', 'link' => 'text-cyan-600 hover:text-cyan-800'],
        'purple' => ['gradient' => 'from-purple-500 to-purple-700', 'badge' => 'bg-purple-100 text-purple-700', 'link' => 'text-purple-600 hover:text-purple-800'],
        'green' => ['gradient' => 'from-green-500 to-green-700', 'badge' => 'bg-green-100 text-green-700', 'link' => 'text-green-600 hover:text-green-800'],
        'amber' => ['gradient' => 'from-amber-500 to-amber-700', 'badge' => 'bg-amber-100 text-amber-700', 'link' => 'text-amber-600 hover:text-amber-800'],
    ];
    $articulos = config('blog.articulos', []);
@endphp
<section id="blog" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-4">Blog & Novedades</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Últimas publicaciones</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Artículos, guías y tendencias sobre tecnología, desarrollo de software y transformación digital para tu negocio.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articulos as $slug => $articulo)
            @php $c = $colorMap[$articulo['color']] ?? $colorMap['blue']; @endphp
            <article class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="h-48 bg-gradient-to-br {{ $c['gradient'] }} flex items-center justify-center">
                    <span class="text-white/80 text-5xl font-bold">{{ strtoupper(substr($articulo['categoria'], 0, 1)) }}</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-2 py-1 {{ $c['badge'] }} text-xs font-semibold rounded">{{ $articulo['categoria'] }}</span>
                        <span class="text-gray-400 text-xs">{{ $articulo['fecha'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $articulo['titulo'] }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $articulo['resumen'] }}</p>
                    <a href="{{ route('blog.show', $slug) }}" class="{{ $c['link'] }} font-semibold text-sm transition">Leer más →</a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition mr-4">
                Ver todos los artículos
            </a>
            <a href="#contacto" class="inline-flex items-center px-6 py-3 text-gray-600 font-semibold hover:text-gray-900 transition">
                Suscribirme al newsletter
            </a>
        </div>
    </div>
</section>
