<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de control
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-6">Bienvenido, <strong>{{ auth()->user()->name }}</strong></p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="p-4 border rounded-lg">
                            <p class="text-sm text-gray-500">Ventas</p>
                            <p class="text-2xl font-semibold">{{ $stats['sales_count'] }}</p>
                            <p class="text-xs text-gray-400">{{ $stats['sales_pending'] }} pendientes</p>
                        </div>
                        <div class="p-4 border rounded-lg">
                            <p class="text-sm text-gray-500">Monto en ventas</p>
                            <p class="text-2xl font-semibold">${{ number_format($stats['sales_total'], 2, ',', '.') }}</p>
                        </div>
                        <div class="p-4 border rounded-lg">
                            <p class="text-sm text-gray-500">Pagos aprobados</p>
                            <p class="text-2xl font-semibold">{{ $stats['payments_approved'] }}</p>
                        </div>
                        @if($isAdmin)
                            <div class="p-4 border rounded-lg">
                                <p class="text-sm text-gray-500">Consultas pendientes</p>
                                <p class="text-2xl font-semibold">{{ $stats['inquiries_pending'] }}</p>
                                <p class="text-xs text-gray-400">{{ $stats['users'] }} usuarios · {{ $stats['products'] }} productos</p>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('sales.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <h3 class="font-semibold">Ventas</h3>
                            <p class="text-sm text-gray-500">Ver y gestionar ventas</p>
                        </a>
                        <a href="{{ route('payments.index') }}" class="block p-4 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <h3 class="font-semibold">Pagos</h3>
                            <p class="text-sm text-gray-500">Historial y nuevos pagos</p>
                        </a>
                        @if($isAdmin)
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

            @if($recentSales->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">Últimas ventas</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500 border-b">
                                        <th class="py-2 pr-4">#</th>
                                        @if($isAdmin)<th class="py-2 pr-4">Cliente</th>@endif
                                        <th class="py-2 pr-4">Estado</th>
                                        <th class="py-2 pr-4">Total</th>
                                        <th class="py-2">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSales as $sale)
                                        <tr class="border-b last:border-0">
                                            <td class="py-2 pr-4">
                                                <a href="{{ route('sales.show', $sale) }}" class="text-blue-600 hover:underline">{{ $sale->id }}</a>
                                            </td>
                                            @if($isAdmin)
                                                <td class="py-2 pr-4">{{ $sale->user->name ?? '—' }}</td>
                                            @endif
                                            <td class="py-2 pr-4">{{ $sale->status }}</td>
                                            <td class="py-2 pr-4">${{ number_format($sale->total_amount, 2, ',', '.') }}</td>
                                            <td class="py-2">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
