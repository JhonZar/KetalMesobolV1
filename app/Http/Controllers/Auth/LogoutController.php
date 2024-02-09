<?php

namespace App\Http\Controllers\Auth;

use App\Events\EmployeeLoggedOut;
use App\Http\Controllers\Controller;
use App\Models\AtencionSucursale;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function showLogoutForm()
    {
        return view('loguot');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('nombre');
        Session::forget('custom_key');
        Session::forget('sucursal');


        $ultimoDato = AtencionSucursale::where('id_usuario', session('usuario_id'))
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ultimoDato) {
            // Actualizar la fecha fin del último registro
            $ultimoDato->update([
                'fechaFin' => Carbon::now(),
            ]);
        }
        Session::forget('usuario_id');
        Session::forget('pedido_id');

        $sessions = app('session.store')->all();
        foreach (array_keys($sessions) as $sessionId) {
            session()->forget($sessionId);
        }
        return redirect('login');
    }
}
