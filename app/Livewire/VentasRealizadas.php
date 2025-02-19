<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Venta;

class VentasRealizadas extends Component
{
    use WithPagination;
    public $venta_seleccionada, $modal_abierto = false;
    public function render()
    {
        // Obtener las ventas con el cliente y ordenarlas por fecha
        $ventas = Venta::with('cliente')->latest()->paginate(10);

        return view('livewire.ventas-realizadas', compact('ventas'));
    }
    public function verDetalles($venta_id)
    {
        $this->venta_seleccionada = Venta::with('detalles.producto')->find($venta_id);
        $this->modal_abierto = true;
    }
    public function regresar()
    {
        return redirect()->route('ventas.realizadas');
    }
    public function cerrarModal()
    {
        $this->modal_abierto = false;
    }
}
