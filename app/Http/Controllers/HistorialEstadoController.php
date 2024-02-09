<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Estado;
use App\Models\HistorialEstado;
use App\Models\Pedido;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class HistorialEstadoController
 * @package App\Http\Controllers
 */
class HistorialEstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historialEstados = HistorialEstado::paginate();

        return view('historial-estado.index', compact('historialEstados'))
            ->with('i', (request()->input('page', 1) - 1) * $historialEstados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pedidosEnProceso = Pedido::where('estado', 'PEDIDO EN PROCESO')
            ->with(['cliente' => function ($query) {
                $query->select('id', 'nombre'); // Seleccionar solo las columnas necesarias
            }])
            ->get();

        // Obtener los destinatarios asociados a los pedidos en proceso
        $destinatarios = Destinatario::whereIn('id_pedido', $pedidosEnProceso->pluck('id'))->get();

        // Puedes organizar los destinatarios según sea necesario
        // Por ejemplo, agruparlos por id_pedido para facilitar el acceso en la vista
        $destinatariosPorPedido = $destinatarios->groupBy('id_pedido');

        // Obtener la lista de usuarios
        $usuarios = Usuario::whereHas('empleado.role', function ($query) {
            $query->where('nombre', 'PRODUCCION');
        })->get();

        $estados = Estado::all();
        $historialEstado = new HistorialEstado();
        return view('historial-estado.create', compact('estados', 'historialEstado', 'pedidosEnProceso', 'destinatariosPorPedido', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Obtener el historial estado existente por ID del pedido
        $historialEstado = HistorialEstado::where('id_pedido', $request->input('id_pedido'))
            ->orderBy('fecha', 'desc') // Asegúrate de ordenar por fecha en orden descendente para obtener el último estado
            ->first();

        // Verificar si se encontró un historial existente
        if ($historialEstado) {
            // Actualizar los atributos
            $historialEstado->id_estado = $request->input('id_estado');
            $historialEstado->id_usuarios = $request->input('id_usuario');
            $historialEstado->fecha = now();
            $historialEstado->save();
            // Obtener el pedido por ID
            $pedido = Pedido::find($request->input('id_pedido'));

            // Verificar si se encontró el pedido
            if ($pedido) {
                $idEstaddo=$request->input('id_estado');
                $estadoP=Estado::find($idEstaddo);
                // Actualizar el estado del pedido
                $pedido->estado = $estadoP->nombre;
                $pedido->save();

                return redirect()->route('historial-estados.index')->with('success', 'HistorialEstado and Pedido updated successfully.');
            } else {
                // Si no se encuentra el pedido, puedes decidir cómo manejar esta situación
                return redirect()->route('historial-estados.index')->with('error', 'No existing pedido found for the given ID.');
            }
           
        } else {
            // Si no se encuentra un historial existente, puedes decidir cómo manejar esta situación
            return redirect()->route('historial-estados.index')->with('error', 'No existing historial found for the given pedido ID.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historialEstado = HistorialEstado::find($id);

        return view('historial-estado.show', compact('historialEstado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $historialEstado = HistorialEstado::find($id);

        return view('historial-estado.edit', compact('historialEstado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  HistorialEstado $historialEstado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorialEstado $historialEstado)
    {
        request()->validate(HistorialEstado::$rules);

        $historialEstado->update($request->all());

        return redirect()->route('historial-estados.index')
            ->with('success', 'HistorialEstado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $historialEstado = HistorialEstado::find($id)->delete();

        return redirect()->route('historial-estados.index')
            ->with('success', 'HistorialEstado deleted successfully');
    }
}
