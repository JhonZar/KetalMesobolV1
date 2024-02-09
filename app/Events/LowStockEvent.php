<?php

namespace App\Events;

use App\Http\Controllers\NotificacionController;
use App\Models\Producto;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LowStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $producto;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Producto $producto)
    {
        $this->producto = $producto;

        $notificacionesSinLeer = DB::table('notifications')
            ->whereNull('read_at')
            ->count();



       // Almacenar el contador en la sesión
       session(['notificaciones_sin_leer' => $notificacionesSinLeer]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
