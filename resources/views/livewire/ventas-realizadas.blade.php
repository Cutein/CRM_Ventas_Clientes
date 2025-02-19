<div class="max-w-7xl mx-auto bg-white rounded py-3 px-4 sm:px-6 lg:px-8">
    <!-- Tabla de Ventas -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Cliente</th>
                <th class="border p-2">Fecha Venta</th>
                <th class="border p-2">Total</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td class="border p-2">{{ $venta->cliente->nombre }}</td>
                    <td class="border p-2">{{ $venta->fecha_venta->format('d-m-Y H:i') }}</td>
                    <td class="border p-2">${{ number_format($venta->total, 2) }}</td>
                    <td class="border p-2 text-right">
                        <button wire:click="verDetalles({{ $venta->id }})" class="bg-blue-600 text-white px-4 py-2 rounded">Ver Detalles</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $ventas->links() }}
    </div>
    <div x-data="{ open: @entangle('modal_abierto') }">
        <!-- Fondo oscuro del modal -->
        <div x-cloak x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <!-- Encabezado -->
                <div class="flex justify-between items-center border-b pb-3">
                    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Detalles de la Venta</h2>
                    <button @click="open = false" wire:click="cerrarModal" 
                        class="text-gray-500 hover:text-red-500 dark:hover:text-red-400 transition duration-200">
                        ✖
                    </button>
                </div>
            
                @if($venta_seleccionada)
                    <!-- Información del Cliente -->
                    <div class="mt-4">
                        <p class="text-lg"><strong class="text-gray-700 dark:text-gray-300">Cliente:</strong> 
                            <span class="text-gray-900 dark:text-white">{{ $venta_seleccionada->cliente->nombre }}</span>
                        </p>
                        <p class="text-lg"><strong class="text-gray-700 dark:text-gray-300">Fecha:</strong> 
                            <span class="text-gray-900 dark:text-white">{{ $venta_seleccionada->fecha_venta->format('Y-m-d H:i:s') }}</span>
                        </p>
                        <p class="text-lg"><strong class="text-gray-700 dark:text-gray-300">Total:</strong> 
                            <span class="text-green-600 dark:text-green-400 font-semibold">${{ number_format($venta_seleccionada->total, 2) }}</span>
                        </p>
                    </div>
            
                    <!-- Tabla de Productos -->
                    <h3 class="mt-6 text-xl font-semibold text-gray-700 dark:text-gray-200">Productos Comprados</h3>
                    <div class="mt-2 overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                                <tr>
                                    <th class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-left">Producto</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-center">Cantidad</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-center">Precio Unitario</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900">
                                @foreach($venta_seleccionada->detalles as $detalle)
                                    <tr class="border-b border-gray-300 dark:border-gray-700">
                                        <td class="px-3 py-2">{{ $detalle->producto->nombre }}</td>
                                        <td class="px-3 py-2 text-center">{{ $detalle->cantidad }}</td>
                                        <td class="px-3 py-2 text-center">${{ number_format($detalle->producto->precio, 2) }}</td>
                                        <td class="px-3 py-2 text-right font-semibold text-green-600 dark:text-green-400">
                                            ${{ number_format($detalle->subtotal, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            
                <!-- Botón para cerrar -->
                <div class="mt-6 text-center">
                    <button @click="open = false" wire:click="cerrarModal" 
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                        Cerrar
                    </button>
                </div>
            </div>            
        </div>
    </div>
</div>
