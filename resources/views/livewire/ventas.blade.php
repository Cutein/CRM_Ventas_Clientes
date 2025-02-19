<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-5">
    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-4">Registrar Venta</h2>

    <!-- Selección de Cliente -->
    <div class="mb-4">
        <label for="cliente" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cliente</label>
        <select wire:model.live="cliente_id" id="cliente" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">Seleccione un cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Selección de Producto -->
    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <label for="producto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Producto</label>
            <select wire:model.live="producto_id" id="producto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - ${{ $producto->precio }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
            <input type="number" wire:model.live="cantidad" id="cantidad" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Cantidad">
            <!-- Mensaje de error -->
            @if($cantidad_invalida)
                <p class="text-red-500 text-sm mt-1">La cantidad supera el stock disponible.</p>
            @endif
        </div>
        <!-- Stock Disponible -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock Disponible</label>
            <input type="text" value="{{ $stock_disponible }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 dark:bg-gray-600 dark:text-white" disabled>
        </div>

        <div class="flex items-end">
            <button wire:click="agregarProducto" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow" @if($cantidad_invalida || !$producto_id || !$cantidad) disabled @endif>Agregar</button>
        </div>
        <!-- Mensaje de advertencia para agregar producto -->
        @if(!$producto_id || !$cantidad || $cantidad_invalida)
            <p class="text-yellow-500 text-sm mt-2 col-span-4">⚠️ Seleccione un producto y una cantidad válida antes de agregar.</p>
        @endif
    
    </div>

    <!-- Tabla de Detalles de Venta -->
    <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-3">Detalles de la Venta</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-200 dark:bg-gray-800">
                    <tr class="text-left">
                        <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">Producto</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">Cantidad</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $detalle)
                        <tr class="bg-white dark:bg-gray-900">
                            <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">{{ $detalle['producto']->nombre }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">{{ $detalle['cantidad'] }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">${{ number_format($detalle['subtotal'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-300 mt-4">Total: <span class="text-green-600 dark:text-green-400">${{ number_format($total, 2) }}</span></h4>
    </div>

    <!-- Botón para Guardar Venta -->
    <div class="mt-4">
        <button wire:click="guardarVenta" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow" @if(count($detalles) == 0 || !$cliente_id) disabled @endif>Guardar Venta</button>
    </div>
    <!-- Mensaje de advertencia para guardar venta -->
    @if(count($detalles) == 0 || !$cliente_id)
        <p class="text-yellow-500 text-sm mt-2">⚠️ Agregue al menos un producto y seleccione un cliente antes de guardar.</p>
    @endif


    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="mt-3 bg-green-100 text-green-700 p-3 rounded-md shadow">
            {{ session('message') }}
        </div>
    @endif
</div>
