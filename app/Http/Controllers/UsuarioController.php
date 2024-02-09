<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::paginate();

        return view('usuario.index', compact('usuarios'))
            ->with('i', (request()->input('page', 1) - 1) * $usuarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = new Usuario();
        $empleado = Empleado::pluck('nombre', 'id');
        return view('usuario.create', compact('usuario', 'empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Usuario::$rules);

        //$usuario = Usuario::create($request->all());

        $usuario = new Usuario();
        $usuario->id_empleado = $request->input('id_empleado');
        $usuario->nombre = $request->input('nombre');
        $usuario->contra = Hash::make($request->input('contra'));
        $usuario->estado = $request->input('estado');
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        return view('usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        $empleado = Empleado::pluck('nombre', 'id');
        return view('usuario.edit', compact('usuario', 'empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        // Define las reglas de validación
        $rules = Usuario::$rules;
        // Si no se proporcionó una nueva contraseña, excluye la regla de validación de la contraseña
        if ($request->has('contra')) {
            unset($rules['contra']);
        }
        // Realiza la validación
        request()->validate($rules);
        // Actualiza los otros campos del usuario
        $usuario->id_empleado = $request->input('id_empleado');
        $usuario->nombre = $request->input('nombre');
        $usuario->estado = $request->input('estado');
        // Si se proporcionó una nueva contraseña, actualiza la contraseña encriptada
        if ($request->filled('contra')) {
            $usuario->contra = Hash::make($request->input('contra'));
        }
        // Guarda los cambios en el modelo
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id)->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario deleted successfully');
    }
}
