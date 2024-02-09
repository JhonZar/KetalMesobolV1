<?php

namespace App\Http\Controllers;

use App\Events\LowStockEvent;
use App\Models\DetallePedido;
use App\Models\Inventario;
use App\Models\Pedido;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Class DetallePedidoController
 * @package App\Http\Controllers
 */
class DetallePedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallePedidos = DetallePedido::paginate();

        return view('detalle-pedido.index', compact('detallePedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallePedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallePedido = new DetallePedido();

        // Asegúrate de importar Carbon al principio de tu archivo si aún no lo has hecho

        $idUsuarioSesion = Session::get('usuario_id');
        $pasoNroPed = Session::get('pasoNroPed');
        $estadoFiltro = Session::get('tipoSalida');
        $fechaActual = Carbon::now();

        $pedidos = Pedido::with('cliente')
            ->whereHas('usuario', function ($query) use ($idUsuarioSesion) {
                $query->where('id', $idUsuarioSesion);
            })
            ->where('estado', $estadoFiltro)
            ->whereDate('fecha', $fechaActual->toDateString()) // Filtrar por la fecha actual
            ->get();

        $opciones = $pedidos->mapWithKeys(function ($pedido) {
            return [$pedido->id => $pedido->cliente->nombre . ' (' . $pedido->cliente->ci . ') Nro: ' . $pedido->id];
        });
        $producto = Producto::pluck('nombre', 'id');
        return view('detalle-pedido.create', compact('detallePedido', 'opciones', 'producto', 'pasoNroPed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(DetallePedido::$rules);
        $request->validate([
            'id_pedido' => DetallePedido::$rules['id_pedido'],
        ]);
        $carrito = session('carrito', []);
        $idPedido = $request->input('id_pedido');
        foreach ($carrito as $producto) {
            $detallePedido = new DetallePedido();
            $detallePedido->id_pedido = $idPedido;
            $detallePedido->id_producto = $producto['id'];
            $detallePedido->cantidad = $producto['cantidad'];
            $detallePedido->precion_unitario = $producto['precio_unitario'];

            $detallePedido->save();


            $productoActual = Producto::find($producto['id']);
            $productoActual->cantidad -= $producto['cantidad'];
            $productoActual->save();

            event(new LowStockEvent($productoActual));

            $inventario = new Inventario();
            $inventario->id_producto = $producto['id'];
            $inventario->id_usuario = session('usuario_id');
            $inventario->fecha = now();
            $inventario->cantidad = -$producto['cantidad']; // Nótese el signo negativo
            $inventario->tipo_Transaccion = 'DECREMENTO'; // Marca como decremento
            $inventario->save();
        }
        $pedidoStatus = Pedido::find($idPedido);
        $pedidoStatus->estado = "VENTA COMPLETA";
        $pedidoStatus->precioTotal = session('precioTotalCarrito');
        $pedidoStatus->pagoACuenta = $request->input('acc');
        $saldo = (session('precioTotalCarrito')) - ($request->input('acc'));
        $pedidoStatus->saldo = $saldo;
        $pedidoStatus->save();
        session()->forget('carrito');
        session()->forget('pedido_id');
        session()->forget('precioTotalCarrito');
        ///NOTIFICACIONES
        $notificacionesSinLeer = DB::table('notifications')
            ->whereNull('read_at')
            ->count();
        // Almacenar el contador en la sesión
        session(['notificaciones_sin_leer' => $notificacionesSinLeer]);
        /// FIN NOTIFICACIONES 
        return redirect()->route('detalle-pedidos.index')
            ->with('success', 'DetallePedido created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallePedido = DetallePedido::find($id);

        return view('detalle-pedido.show', compact('detallePedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallePedido = DetallePedido::find($id);
        $opciones = [];
        $producto = Producto::pluck('nombre', 'id');
        return view('detalle-pedido.edit', compact('detallePedido', 'opciones', 'producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetallePedido $detallePedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePedido $detallePedido)
    {
        request()->validate(DetallePedido::$rules);

        $detallePedido->update($request->all());

        return redirect()->route('detalle-pedidos.index')
            ->with('success', 'DetallePedido updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallePedido = DetallePedido::find($id)->delete();

        return redirect()->route('detalle-pedidos.index')
            ->with('success', 'DetallePedido deleted successfully');
    }
}
