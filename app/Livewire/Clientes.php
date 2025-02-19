<?php

namespace App\Livewire;
use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;
    public $nombre, $email, $telefono, $direccion, $cliente_id;
    public $search = '';
    public $modal = false;

    public function render()
    {
        $clientes = Cliente::query()
        ->when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('telefono', 'like', '%' . $this->search . '%')
                  ->orWhere('direccion', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'asc')->paginate(10);
        return view('livewire.clientes', compact('clientes'));

    }

    public function crear()
    {
        $this->resetInputs();
        $this->modal = true;
    }

    public function guardar()
    {
        try{
            $this->validate([
                'nombre' => 'required',
                'email' => 'required|email|unique:clientes,email,' . $this->cliente_id,
            ]);
    
            Cliente::updateOrCreate(['id' => $this->cliente_id], [
                'nombre' => $this->nombre,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]);
    
            session()->flash('message', $this->cliente_id ? 'Cliente actualizado.' : 'Cliente creado.');
            $this->modal = false;
            $this->resetInputs();
            $this->dispatch('notificar', message: 'Nuevo Cliente Creado.', type: 'success');
        }catch(\Exception $e){
            $this->dispatch('notificar', message: 'No se pudo crear el cliente.', type: 'error');
        }

    }

    public function editar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->cliente_id = $cliente->id;
        $this->nombre = $cliente->nombre;
        $this->email = $cliente->email;
        $this->telefono = $cliente->telefono;
        $this->direccion = $cliente->direccion;
        $this->modal = true;
    }

    public function eliminar($id)
    {
        try{
            Cliente::findOrFail($id)->delete();
            $this->dispatch('notificar', message: 'Cliente Eliminado.', type: 'success');
        }catch(\Exception $e){
            $this->dispatch('notificar', message: 'No se pudo eliminar el cliente.', type: 'error');
        }
    }

    private function resetInputs()
    {
        $this->nombre = '';
        $this->email = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->cliente_id = null;
    }
}
