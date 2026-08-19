<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de control
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">Bienvenido, <strong>{{ auth()->user()->name }}</strong></p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('sales.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <h3 class="font-semibold">Ventas</h3>
                            <p class="text-sm text-gray-500">Ver y gestionar ventas</p>
                        </a>
                        <a href="{{ route('payments.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <h3 class="font-semibold">Pagos</h3>
                            <p class="text-sm text-gray-500">Historial y nuevos pagos</p>
                        </a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('products.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                <h3 class="font-semibold">Productos</h3>
                                <p class="text-sm text-gray-500">Administrar catálogo</p>
                            </a>
                            <a href="{{ route('users.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                <h3 class="font-semibold">Usuarios</h3>
                                <p class="text-sm text-gray-500">Gestionar usuarios</p>
                            </a>
                            <a href="{{ route('inquiries.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                <h3 class="font-semibold">Consultas</h3>
                                <p class="text-sm text-gray-500">Mensajes del sitio web</p>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
