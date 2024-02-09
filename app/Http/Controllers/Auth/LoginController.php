<?php

namespace App\Http\Controllers\Auth;

use App\Events\EmployeeLoggedIn;
use App\Events\LowStockEvent;
use App\Http\Controllers\Controller;
use App\Models\AtencionSucursale;
use App\Models\Sucursale;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = '/categorias';
    public function showLoginForm()
    {
        $sucursal = Sucursale::pluck('nombre', 'id');
        return view('login', compact('sucursal'));
    }
    public function login(Request $request)
    {
        $nombre = $request->input('nombre');
        $contra = $request->input('contra');
        $sucursal = $request->input('sucursal');

        $usuario = Usuario::where('nombre', $nombre)->first();

        if ($usuario && Hash::check($contra, $usuario->contra)) {
            // La contraseña ingresada coincide con el hash almacenado

            ///NOTIFICACIONES
            $notificacionesSinLeer = DB::table('notifications')
                ->whereNull('read_at')
                ->count();
            // Almacenar el contador en la sesión
            session(['notificaciones_sin_leer' => $notificacionesSinLeer]);
            /// FIN NOTIFICACIONES 
            if ($usuario->estado == 1) {
                $roles = DB::table('usuarios')
                    ->join('empleados', 'usuarios.id_empleado', '=', 'empleados.id')
                    ->join('roles', 'empleados.id_rol', '=', 'roles.id')
                    ->where('usuarios.nombre', $nombre)
                    ->pluck('roles.nombre');
                Session::put('usuario_id', $usuario->id);
                Session::put('nombre', $usuario->nombre);
                Session::put('sucursal', $sucursal);
                $atencionSucursale = AtencionSucursale::create([
                    'id_usuario' => $usuario->id,
                    'id_sucursal' => $sucursal,
                    'fechaInicio' => Carbon::now(),
                ]);

                if (Session::has('usuario_id') && Session::has('nombre') && ($roles[0] == "PRODUCCION")) {
                    // Sesiones creadas correctamente, redirigir a la página deseada

                    return redirect($this->redirectTo);
                }
                if (Session::has('usuario_id') && Session::has('nombre') && ($roles[0] == "VENTAS")) {
                    // Sesiones creadas correctamente, redirigir a la página deseada
                    return redirect('productos');
                }
            } else {
                // El usuario está inactivo, mostrar un mensaje de error
                return redirect()->route('log
                in')
                    ->with('success', 'El Usuario esta incativo');
            }
        } else {
            // La contraseña ingresada no coincide con el hash almacenado
            return redirect()->route('login')
                ->with('success', 'Los datos ingresados son INVALIDOS!');
        }
    }
}
