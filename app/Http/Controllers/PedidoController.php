<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Destinatario;
use App\Models\Pedido;
use Illuminate\Http\Request;

/**
 * Class PedidoController
 * @package App\Http\Controllers
 */
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::paginate();

        return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pedido = new Pedido();
        $clientes = Cliente::all();
        $destinatario = Destinatario::all();
        return view('pedido.create', compact('pedido', 'clientes', 'destinatario'));
    }

    public function buscarClientes(Request $request)
    {
        $query = $request->input('q');
        $nombreCompleto = Cliente::all();
        $clientes = Cliente::where('nombre', 'LIKE', "%$query%")
            ->orWhere('apellido', 'LIKE', "%$query%")
            ->orWhere('ci', 'LIKE', "%$query%")
            ->get();
        $clieente = Cliente::selectRaw("CONCAT(nombre, ' ', apellido) as nombre_completo, id");
        $pedido = new Pedido();  // Puedes mantener esto si es necesario para la vista
        $tipoTransaccion = session('tipoSalida');

        if ($tipoTransaccion === 'PEDIDO') {
            // Si es una transacción de tipo PEDIDO, redirige a la ruta correspondiente
            return redirect()->route('destinatarios.create', compact('clientes', 'clieente'));
        }  else {
            // En caso de otro tipo de transacción o sin definir, puedes manejarlo de acuerdo a tus necesidades
            return redirect()->route('pedidos.create', compact('clientes', 'clieente'));
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pedido::$rules);
        $tipoSalida = $request->input('estado');
        session(['tipoSalida' => $tipoSalida]);

        $pedido = Pedido::create($request->all());
        $pasoNroPed = $pedido->id;
        session(['pasoNroPed' => $pasoNroPed]);
        $agregado = 'pedido nro ' . $pedido->id . ' cliente: ' . $request->input('id_cliente');
        session(['pedido_id' => $agregado]);
        session(['id_cliee'=>$request->input('id_cliente')]);
            return redirect()->route('productos.index')
                ->with('success', 'Pedido created successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);

        return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $clientes = Cliente::all();
        return view('pedido.edit', compact('pedido', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        request()->validate(Pedido::$rules);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }
}
