<?php

namespace App\Listeners;

use App\Events\LowStockEvent;
use App\Models\Usuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLowStockNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LowStockEvent  $event
     * @return void
     */
    public function handle(LowStockEvent $event)
    {
        
        $producto=$event->producto;
        $cantidadMinima = 10;
        if ($producto->cantidad <$cantidadMinima) {
            $usuarioId = session('usuario_id');
            $$usuarioId = session('usuario_id');
            $usuario = Usuario::find($usuarioId);

            if ($usuario) {
                $usuario->notify(new \App\Notifications\LowStockNotification($producto));
            }
        }
    }
}
