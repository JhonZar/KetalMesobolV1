<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class NotificacionController extends Controller
{
    public function mostrarModalConNotificaciones()
    {
        $notificaciones = DB::table('notifications')
            ->orderBy('created_at', 'desc')
            ->get();

        // Formatear las notificaciones
        $notificaciones = $this->formatearNotificaciones($notificaciones);

        return view('notificacion.tu-vista-modal', compact('notificaciones'));
    }

    private function formatearNotificaciones($notificaciones)
    {
        return $notificaciones->map(function ($notificacion) {
            $data = json_decode($notificacion->data);
            $message = $data->message ?? null;
            $productId = $data->product_id ?? null;
            $isRead = $notificacion->read_at ? true : false;

            // Obtener la diferencia de tiempo entre la fecha actual y la fecha de lectura
            $readAtDiff = $notificacion->read_at ? now()->diff($notificacion->read_at) : null;

            return (object) [
                'id' => $notificacion->id,
                'message' => $message,
                'productId' => $productId,
                'isRead' => $isRead,
                'readAtDiff' => $readAtDiff,
            ];
        });
    }

    public function marcarLeida(Request $request, $id)
    {
        $notificacion = DB::table('notifications')->where('id', $id)->first();

        if ($notificacion) {
            // Puedes actualizar aquí otros campos si es necesario
            DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
            ///NOTIFICACIONES
            $notificacionesSinLeer = DB::table('notifications')
                ->whereNull('read_at')
                ->count();
            // Almacenar el contador en la sesión
            session(['notificaciones_sin_leer' => $notificacionesSinLeer]);
            /// FIN NOTIFICACIONES 
            return redirect()->route('mostrar-modal-notificaciones');
        }

        return response()->json(['error' => 'Notificación no encontrada'], 404);
    }
}
