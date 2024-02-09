<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PedidosClientesController extends Controller
{
    public function mostrarFormulario()
    {
        return view('PedidosClientes.formulario'); // Verifica que la carpeta sea 'PedidosClientes' y no 'PedidosCLientes'
    }

    public function mostrarInformacionCliente(Request $request)
    {
        $ci = $request->input('ci_cliente');
        $cliente = Cliente::where('ci', $ci)->first();
    
        if ($cliente) {
            // Obtener pedidos asociados al cliente
            $pedidos = Pedido::where('id_cliente', $cliente->id)->get();
    
            // Obtener nombres de estados disponibles
            $nombresEstados = Estado::pluck('nombre')->all();
    
            // Mostrar la vista con la información del cliente y sus pedidos
            return view('PedidosClientes.informacion', compact('cliente', 'pedidos', 'nombresEstados'));
        } else {
            // Redireccionar con un mensaje de error si el cliente no se encuentra
            return redirect()->route('formulario-cliente')->with('error', 'Cliente no encontrado');
        }
    }
    
}
