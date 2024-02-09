<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Destinatario;
use App\Models\HistorialEstado;
use App\Models\Inventario;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class DestinatarioController
 * @package App\Http\Controllers
 */
class DestinatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = app('session.store')->all();

        $destinatarios = Destinatario::paginate();

        return view('destinatario.index', compact('destinatarios'))
            ->with('i', (request()->input('page', 1) - 1) * $destinatarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sesiones = session()->all();

        $destinatario = new Destinatario();
        $clientes = Cliente::all();
        $pedido = new Pedido();
        return view('destinatario.create', compact('destinatario', 'clientes', 'pedido', 'sesiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate(Destinatario::$rules);

        // Obtén la lista de clientes seleccionados en la sesión
        $clientesSeleccionados = session('clientes_seleccionados', []);
        $carrito = session('carrito', []);

        $cantidad = session('carrito.0.cantidad');

        $principalCli = session('id_cliee');
       
        $tamanoClientesSeleccionados = count($clientesSeleccionados);
        
        $idProd=$request->input('id_producto');




        // Recorre los clientes seleccionados y crea un destinatario para cada uno
        foreach ($clientesSeleccionados as $clienteId) {
            $destinatario = new Destinatario();
            $destinatario->id_pedido = $request->input('id_pedido');
            $destinatario->id_cliente = $clienteId; // Asigna el ID de cliente seleccionado
            $destinatario->id_producto = $request->input('id_producto');
            $destinatario->cantidad = 1;
            $destinatario->fecha_Entrega = $request->input('fecha_Entrega');
            $destinatario->talla = 2;
            $destinatario->obs = $request->input('observaciones');
            $destinatario->save();
           
        }
        
            $destinatario = new Destinatario();
            $destinatario->id_pedido = session('pasoNroPed');
            $destinatario->id_cliente = $principalCli; // Asigna el ID de cliente seleccionado
            $destinatario->id_producto = $idProd;
            $destinatario->cantidad = $cantidad-$tamanoClientesSeleccionados;
            $destinatario->fecha_Entrega = $request->input('fecha_Entrega');
            $destinatario->talla = 2;
            $destinatario->obs = $request->input('observaciones');
            $destinatario->save();
           
        
        foreach ($carrito as $producto) {
            $productoActual = Producto::find($producto['id']);
            $productoActual->cantidad -= $producto['cantidad'];
            $productoActual->save();

            $inventario = new Inventario();
            $inventario->id_producto = $producto['id'];
            $inventario->id_usuario = session('usuario_id');
            $inventario->fecha = now();
            $inventario->cantidad = -$producto['cantidad']; // Nótese el signo negativo
            $inventario->tipo_Transaccion = 'DECREMENTO'; // Marca como decremento
            $inventario->save();
        }
        $pedidoStatus = Pedido::find($request->input('id_pedido'));
        $pedidoStatus->estado = "PEDIDO EN PROCESO";
        $pedidoStatus->precioTotal = session('precioTotalCarrito');
        $pedidoStatus->pagoACuenta = $request->input('acc');
        $saldo = (session('precioTotalCarrito')) - ($request->input('acc'));
        $pedidoStatus->saldo = $saldo;
        $pedidoStatus->save();

        $historialEstado = new HistorialEstado();
        $historialEstado->id_estado = 1; // Reemplaza con el campo correcto según tu lógica
        $historialEstado->id_pedido = $pedidoStatus->id; // Reemplaza con el campo correcto según tu lógica
       // $historialEstado->id_usuarios = session('usuario_id'); // Reemplaza con el campo correcto según tu lógica
        $historialEstado->fecha = now(); // Puedes ajustar la fecha según tus necesidades
        $historialEstado->save();

        session()->forget('carrito');
        session()->forget('tipoSalida');
        session()->forget('clientes_seleccionados');
        session()->forget('pasoNroPed');
        session()->forget('pedido_id');
        session()->forget('precioTotalCarrito');
        return redirect()->route('destinatarios.index')
            ->with('success', 'Destinatarios created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destinatario = Destinatario::find($id);

        return view('destinatario.show', compact('destinatario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destinatario = Destinatario::find($id);

        return view('destinatario.edit', compact('destinatario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Destinatario $destinatario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinatario $destinatario)
    {
        request()->validate(Destinatario::$rules);

        $destinatario->update($request->all());

        return redirect()->route('destinatarios.index')
            ->with('success', 'Destinatario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $destinatario = Destinatario::find($id)->delete();

        return redirect()->route('destinatarios.index')
            ->with('success', 'Destinatario deleted successfully');
    }
}
