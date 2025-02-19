<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use Livewire\WithPagination;

class Productos extends Component
{
    use WithPagination;

    public $nombre, $descripcion, $precio, $cantidad, $producto_id;
    public $modal = false;
    public $search = '';

    // Función para mostrar los productos y buscar
    public function render()
    {
        $productos = Producto::query()
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                    ->orWhere('precio', 'like', '%' . $this->search . '%')
                    ->orWhere('cantidad', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.productos', compact('productos'));
    }

    // Abrir el modal de creación
    public function crear()
    {
        $this->resetInputs();
        $this->modal = true;
    }

    // Guardar o actualizar un producto
    public function guardar()
    {
        try{
            $this->validate([
                'nombre' => 'required',
                'precio' => 'required|numeric',
                'cantidad' => 'required|integer',
            ]);
    
            Producto::updateOrCreate(
                ['id' => $this->producto_id],
                [
                    'nombre' => $this->nombre,
                    'descripcion' => $this->descripcion,
                    'precio' => $this->precio,
                    'cantidad' => $this->cantidad,
                ]
            );
            $this->modal = false;
            $this->resetInputs();
            $this->dispatch('notificar', message: 'Producto agregado con éxito.', type: 'success');

        }catch(\Exception $e){
            $this->dispatch('notificar', message: 'Fallo al crear el producto.', type: 'error');

        }
    }

    // Editar un producto
    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        $this->producto_id = $producto->id;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->cantidad = $producto->cantidad;
        $this->modal = true;
    }

    // Eliminar un producto
    public function eliminar($id)
    {
        try {
            Producto::findOrFail($id)->delete();
            $this->dispatch('notificar', message: 'Producto eliminado.', type: 'success');

        } catch (\Exception $e) {
            $this->dispatch('notificar', message: 'No se pudo eliminar el producto.', type: 'success');

        }
    }

    // Limpiar los campos del formulario
    private function resetInputs()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->cantidad = '';
        $this->producto_id = null;
    }
}
