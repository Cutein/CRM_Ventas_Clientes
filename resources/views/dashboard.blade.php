<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tarjetas de Resumen -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center">
                    <div class="bg-blue-500 p-4 rounded-full text-white">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Ventas</h3>
                        <p class="text-2xl font-bold">{{ number_format($totalVentas ?? 0, 2) }} USD</p>
                    </div>
                </div>  
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center">
                    <div class="bg-green-500 p-4 rounded-full text-white">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Clientes Activos</h3>
                        <p class="text-2xl font-bold">{{ $totalClientes ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center">
                    <div class="bg-yellow-500 p-4 rounded-full text-white">
                        <i class="fas fa-box text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Stock Bajo</h3>
                        <p class="text-2xl font-bold">{{ $productosBajoStock ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Ventas Recientes</h3>
                <livewire:ventas-grafico />
            </div>
        </div>
    </div>
</x-app-layout>
