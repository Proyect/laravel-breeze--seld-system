@extends('layouts.landing-tailwind')

@section('title', 'Búsqueda | Infrasoft')

@section('container')
<div class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Resultados de búsqueda</h1>

    <form method="GET" action="{{ route('site.search') }}" class="mb-8 flex gap-2">
        <input type="text" name="q" value="{{ $query }}" placeholder="Buscar servicios o artículos..."
               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">Buscar</button>
    </form>

    @if(!empty($query))
        <p class="text-gray-600 mb-8">{{ count($search) }} resultado(s) para: <strong>{{ $query }}</strong></p>
    @endif

    @forelse($search as $item)
        <a href="{{ $item['url'] ?? '#' }}" class="block bg-white rounded-lg shadow p-4 mb-4 hover:shadow-md transition">
            <span class="text-xs font-semibold uppercase text-blue-600">{{ $item['tipo'] ?? 'Resultado' }}</span>
            <h2 class="text-xl font-semibold mt-1">{{ $item['title'] ?? 'Resultado' }}</h2>
            <p class="text-gray-600">{{ $item['descripcion'] ?? '' }}</p>
        </a>
    @empty
        @if(!empty($query))
            <p class="text-gray-500">No se encontraron resultados.</p>
        @else
            <p class="text-gray-500">Ingresá un término para buscar en servicios y artículos del blog.</p>
        @endif
    @endforelse
</div>
@endsection
