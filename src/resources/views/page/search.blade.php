@extends('layouts.landing-tailwind')

@section('title', 'Búsqueda | Infrasoft')

@section('container')
<div class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Resultados de búsqueda</h1>

    @if(!empty($query))
        <p class="text-gray-600 mb-8">Buscando: <strong>{{ $query }}</strong></p>
    @endif

    @forelse($search as $item)
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <h2 class="text-xl font-semibold">{{ $item['title'] ?? 'Resultado' }}</h2>
            <p class="text-gray-600">{{ $item['descripcion'] ?? '' }}</p>
        </div>
    @empty
        <p class="text-gray-500">No se encontraron resultados.</p>
    @endforelse
</div>
@endsection
