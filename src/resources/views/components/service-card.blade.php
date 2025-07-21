<div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center text-center hover:scale-105 hover:shadow-2xl transition-all duration-300 group cursor-pointer">
    <div class="mb-4">
        @isset($icon)
            {!! $icon !!}
        @else
            <span class="inline-block w-12 h-12 bg-gray-200 rounded-full"></span>
        @endisset
    </div>
    <h3 class="text-xl font-bold mb-2 text-blue-700 group-hover:text-blue-900 transition">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $description }}</p>
    @if(isset($link))
        <a href="{{ $link }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Más info</a>
    @endif
</div> 