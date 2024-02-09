<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\HistorialEstado;
use App\Models\Pedido;
use Illuminate\Http\Request;

class HistorialPedidoController extends Controller
{
    public function listarHistorialesPorUsuario()
    {
        // Obtén el ID de usuario de la sesión
        $idUsuario = session('usuario_id');

        // Busca todos los historiales de pedidos asociados al ID de usuario
        $historiales = HistorialEstado::where('id_usuarios', $idUsuario)->get();

        // Obtén todos los estados disponibles para el formulario de cambio de estado
        $estadosDisponibles = Estado::all();

        // Pasa los resultados a la vista
        return view('historial.listar', compact('historiales', 'estadosDisponibles'));
    }
    
    public function cambiarEstado(Request $request, $idHistorial)
    {
        // Validar la entrada del formulario
        $request->validate([
            'id_estado' => 'required|exists:estados,id',
        ]);

        // Obtener el historial estado por ID
        $historialEstado = HistorialEstado::find($idHistorial);

        // Verificar si se encontró el historial estado
        if ($historialEstado) {
            // Actualizar el estado del historial
            $historialEstado->id_estado = $request->input('id_estado');
            $historialEstado->fecha = now();
            $historialEstado->save();

            // Obtener el pedido asociado al historial
            $pedido = Pedido::find($historialEstado->id_pedido);

            // Actualizar el estado del pedido
            if ($pedido) {
                $pedido->estado = $historialEstado->estado->nombre;
                $pedido->save();
            }

            return redirect()->route('historial.listar')->with('success', 'Estado cambiado exitosamente.');
        } else {
            return redirect()->route('historial.listar')->with('error', 'No se encontró el historial estado.');
        }
    }
}
