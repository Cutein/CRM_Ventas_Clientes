<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Venta;

class VentasGrafico extends Component
{
    public $ventasData;

    public function mount()
    {
        // Obtener las ventas de los últimos 7 días
        $this->ventasData = Venta::selectRaw('DATE(fecha_venta) as fecha, SUM(total) as total')
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->take(7)
            ->get();

        // Si no hay ventas, aseguramos que el gráfico tenga un dato con valor 0
        if ($this->ventasData->isEmpty()) {
            $this->ventasData = collect([['fecha' => now()->format('Y-m-d'), 'total' => 0]]);
        }
    }

    public function render()
    {
        return view('livewire.ventas-grafico');
    }
}
