<?php

namespace App\Listeners;

use App\Events\EmployeeLoggedIn;
use App\Events\EmployeeLoggedOut;
use App\Models\AtencionSucursale;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class LogEmployeeSession
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    public function handleEmployeeLoggedIn(EmployeeLoggedIn $event)
    {
        $userId=Session::get('usuario_id');
        $sucursalId=Session::get('sucursal');
        AtencionSucursale::create([
            'id_usuario' => $event->usuario->id,
            'id_sucursal' => $event->usuario->sucursal,
            'fechaInicio' => now(),
        ]);
    }

    public function handleEmployeeLoggedOut(EmployeeLoggedOut $event){
        
        $userId=$event->usuario->id;

        AtencionSucursale::where('id_usuario',$userId)
        ->whereNull('fechaFin')
        ->update(['fechaFin'=>now()]);
    }
}
