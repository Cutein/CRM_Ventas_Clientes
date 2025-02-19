<!-- resources/views/livewire/productos.blade.php -->

<div class="max-w-7xl mx-auto bg-white rounded py-3 px-4 sm:px-6 lg:px-8">
    <!-- Buscador -->
    <button wire:click="crear()" class="rounded-lg border bg-blue-500 text-white px-4 py-2 mb-3">Nuevo Producto</button>
    <input type="text" wire:model.live="search" class="float-right form-control mb-3" placeholder="Buscar productos..." />

    @if($productos->isNotEmpty())
    <!-- Tabla de productos -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Nombre</th>
                <th class="border p-2">Descripción</th>
                <th class="border p-2">Precio</th>
                <th class="border p-2">Cantidad</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td class="border p-2">{{ $producto->nombre }}</td>
                    <td class="border p-2">{{ $producto->descripcion }}</td>
                    <td class="border p-2">${{ number_format($producto->precio, 2) }}</td>
                    <td class="border p-2">{{ $producto->cantidad }}</td>
                    <td class="border p-2 text-right">
                        <button wire:click="editar({{ $producto->id }})" class="rounded bg-yellow-500 text-white px-2 py-1">Editar</button>
                        <button wire:click="eliminar({{ $producto->id }})" class="rounded bg-red-500 text-white px-2 py-1">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div>
            <td colspan="3" class="text-center">No hay productos registrados.</td>
        </div>
    @endif
    <!-- Paginación -->
    {{ $productos->links() }}

    <!-- Modal de creación/edición -->
    @if($modal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full sm:w-96">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">{{ $producto_id ? 'Editar Producto' : 'Nuevo Producto' }}</h2>
    
            <div class="space-y-4">
                <div>
                    <input type="text" wire:model="nombre" placeholder="Nombre" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div>
                    <input type="text" wire:model="descripcion" placeholder="Descripcion" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div>
                    <input type="number" wire:model="precio" placeholder="Precio" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('precio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div>
                    <input type="number" wire:model="cantidad" placeholder="Cantidad" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('cantidad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div class="flex justify-end space-x-4 mt-6">
                    <button wire:click="$set('modal', false)" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 focus:outline-none transition-all duration-200">
                        Cancelar
                    </button>
                    <button wire:click="guardar()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none transition-all duration-200">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    @endif
</div>
