<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class VistasPublicasController extends Controller
{
    public function mostrarProductos()
    {
        // Obtén todos los productos
        
        $productos = Producto::where('publico', 'si')->paginate(6); // 9 productos por página

        // Pasa los productos a la vista principal
        return view('welcome', compact('productos'));
    }
}
