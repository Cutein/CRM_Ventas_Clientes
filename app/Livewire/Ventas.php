<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;

class Ventas extends Component
{
    use WithPagination;

    public $cliente_id, $producto_id, $cantidad, $total = 0;
    public $venta_id, $detalles = [];
    public $stock_disponible = 0, $cantidad_invalida = false;
    public $boton_agregar_habilitado = false, $boton_guardar_habilitado = false;

    public function render()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('livewire.ventas', compact('clientes', 'productos'));
    }

    public function agregarProducto()
    {
        try{
            $producto = Producto::find($this->producto_id);
            $subtotal = $producto->precio * $this->cantidad;
            $this->total += $subtotal;
    
            $this->detalles[] = [
                'producto' => $producto,
                'cantidad' => $this->cantidad,
                'subtotal' => $subtotal,
            ];
    
            $this->reset('producto_id', 'cantidad');
            $this->dispatch('notificar', message: 'Producto Agregado.', type: 'success');
        }catch(\Exception $e){
            $this->dispatch('notificar', message: 'No se pudo agregar el productp.', type: 'error');
        }
    }

    public function guardarVenta()
    {
        try {
            $venta = Venta::create([
                'cliente_id' => $this->cliente_id,
                'total' => $this->total,
                'fecha_venta' => now(),
            ]);
    
            foreach ($this->detalles as $detalle) {
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $detalle['producto']->id,
                    'cantidad' => $detalle['cantidad'],
                    'precio' => $detalle['producto']->precio,
                    'subtotal' => $detalle['subtotal'],
                ]);
    
                $detalle['producto']->decrement('stock', $detalle['cantidad']);
            }
            $this->resetForm();
            $this->dispatch('notificar', message: 'Venta registrada con exito.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notificar', message: 'Error al registrar la venta.', type: 'error');
        }

    }

    public function resetForm()
    {
        $this->cliente_id = null;
        $this->producto_id = null;
        $this->cantidad = null;
        $this->detalles = [];
        $this->total = 0;
    }

    public function updatedProductoId()
    {
        if ($this->producto_id) {
            $producto = Producto::find($this->producto_id);
            $this->stock_disponible = $producto ? $producto->stock : 0;
        } else {
            $this->stock_disponible = 0;
        }
        $this->validarCantidad();
        $this->actualizarEstadoBotones();
    }
    public function updatedCantidad()
    {
        $this->validarCantidad();
        $this->actualizarEstadoBotones();
    }

    private function validarCantidad()
    {
        $this->cantidad_invalida = $this->cantidad > $this->stock_disponible;
    }
    private function actualizarEstadoBotones()
    {
        // Botón Agregar solo habilitado si hay un producto seleccionado y una cantidad válida
        $this->boton_agregar_habilitado = $this->producto_id && !$this->cantidad_invalida;
    
        // Botón Guardar solo habilitado si hay productos en la venta y un cliente seleccionado
        $this->boton_guardar_habilitado = !empty($this->detalles) && $this->cliente_id;
    }
}
