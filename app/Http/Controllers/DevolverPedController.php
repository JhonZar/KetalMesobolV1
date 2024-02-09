<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;

class DevolverPedController extends Controller
{
    public function index()
    {
        return view('devolverPedido.index');
    }

    public function buscarPedidosPorCI(Request $request)
    {
        $ciCliente = $request->input('ci');

        // Validar que el CI esté presente en la solicitud
        if (!$ciCliente) {
            return redirect()->route('devolver-pedido.index')->with('error', 'Ingrese el CI del cliente para buscar.');
        }

        // Buscar el cliente por CI
        $cliente = Cliente::where('ci', $ciCliente)->first();

        // Validar si el cliente existe
        if (!$cliente) {
            return redirect()->route('devolver-pedido.index')->with('error', 'Cliente no encontrado.');
        }

        // Obtener los pedidos asociados al cliente
        $pedidos = Pedido::whereHas('cliente', function ($query) use ($ciCliente) {
            $query->where('ci', $ciCliente);
        })->get();

        return view('devolverPedido.index', compact('cliente', 'pedidos'));
    }
    public function cambiarEstadoPedido(Request $request, $idPedido)
    {
        $idEstado = $request->input('id_estado');
        $nuevoPrecioTotal = $request->input('precio_total');
        $nuevoPagoACuenta = $request->input('pago_a_cuenta');
        $nuevoSaldo = $request->input('nuevo_saldo'); // Asegúrate de que el nombre sea correcto
    
        $pedido = Pedido::find($idPedido);
        $pedido->estado = $idEstado;
        $acuenta=$pedido->pagoACuenta + $nuevoSaldo;
        $pedido->pagoACuenta = $acuenta;
        $sal=$pedido->precioTotal-$acuenta;
        $pedido->saldo = $sal;
        
       
        $pedido->save();

        return redirect()->route('buscar-pedidos')->with('success', 'Estado del pedido cambiado exitosamente.');
    }
}
