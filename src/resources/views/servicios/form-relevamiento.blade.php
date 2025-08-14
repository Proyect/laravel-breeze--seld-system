<form method="POST" action="{{ route('servicios.relevamiento', $slug) }}" class="bg-white rounded-lg shadow p-8 space-y-6 mt-8">
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
        <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required value="{{ old('name') }}">
    </div>
    <div>
        <label class="block mb-1 font-medium">Email</label>
        <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" required value="{{ old('email') }}">
    </div>
    <div>
        <label class="block mb-1 font-medium">Mensaje</label>
        <textarea name="mensaje" class="w-full border border-gray-300 rounded px-3 py-2" rows="4" required>{{ old('mensaje') }}</textarea>
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition">Enviar relevamiento</button>
</form> 