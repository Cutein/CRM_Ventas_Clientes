<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 bg-white rounded">
    <button wire:click="crear()" class="rounded-lg border bg-blue-500 text-white px-4 py-2 mb-3">Nuevo Cliente</button>
    <input type="text" wire:model.live="search" class="float-right form-control mb-3" placeholder="Buscar clientes..." />
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-2">{{ session('message') }}</div>
    @endif

    @if($clientes->isNotEmpty())

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Nombre</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Teléfono</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border">
                            <td class="border p-2">{{ $cliente->id }}</td>
                            <td class="border p-2">{{ $cliente->nombre }}</td>
                            <td class="border p-2">{{ $cliente->email }}</td>
                            <td class="border p-2">{{ $cliente->telefono }}</td>
                            <td class="border p-2 text-right">
                                <button wire:click="editar({{ $cliente->id }})" class="rounded bg-yellow-500 text-white px-2 py-1">Editar</button>
                                <button wire:click="eliminar({{ $cliente->id }})" class="rounded bg-red-500 text-white px-2 py-1">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        <!-- Enlaces de paginación -->
        <div>
            {{ $clientes->links() }}
        </div>
    @else
        <div>
            <td colspan="3" class="text-center">No hay clientes registrados.</td>
        </div>
    @endif
    <!-- Modal -->
    @if($modal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full sm:w-96">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">{{ $cliente_id ? 'Editar Cliente' : 'Nuevo Cliente' }}</h2>
    
            <div class="space-y-4">
                <div>
                    <input type="text" wire:model="nombre" placeholder="Nombre" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div>
                    <input type="email" wire:model="email" placeholder="Email" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div>
                    <input type="text" wire:model="telefono" placeholder="Teléfono" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div>
                    <input type="text" wire:model="direccion" placeholder="Dirección" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('direccion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
