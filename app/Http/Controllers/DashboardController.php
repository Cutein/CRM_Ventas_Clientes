<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;

class DashboardController extends Controller
{
    public function index()
    {
        // Datos para el dashboard
        $totalVentas = Venta::sum('total') ?? 0; // Si no hay ventas, devuelve 0
        $totalClientes = Cliente::count() ?? 0;  // Si no hay clientes, devuelve 0
        $productosBajoStock = Producto::where('stock', '<=', 5)->count() ?? 0;
    
        return view('dashboard', compact('totalVentas', 'totalClientes', 'productosBajoStock'));
    }
    
}
