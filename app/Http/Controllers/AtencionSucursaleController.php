<?php

namespace App\Http\Controllers;

use App\Models\AtencionSucursale;
use App\Models\Sucursale;
use App\Models\Usuario;
use Illuminate\Http\Request;

/**
 * Class AtencionSucursaleController
 * @package App\Http\Controllers
 */
class AtencionSucursaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atencionSucursales = AtencionSucursale::paginate();
        $usuario=Usuario::pluck('nombre','id');
        $sucursal=Sucursale::pluck('nombre','id');
        return view('atencion-sucursale.index', compact('atencionSucursales','usuario','sucursal'))
            ->with('i', (request()->input('page', 1) - 1) * $atencionSucursales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atencionSucursale = new AtencionSucursale();
        return view('atencion-sucursale.create', compact('atencionSucursale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AtencionSucursale::$rules);

        $atencionSucursale = AtencionSucursale::create($request->all());

        return redirect()->route('atencion-sucursales.index')
            ->with('success', 'AtencionSucursale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atencionSucursale = AtencionSucursale::find($id);

        return view('atencion-sucursale.show', compact('atencionSucursale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atencionSucursale = AtencionSucursale::find($id);

        return view('atencion-sucursale.edit', compact('atencionSucursale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AtencionSucursale $atencionSucursale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtencionSucursale $atencionSucursale)
    {
        request()->validate(AtencionSucursale::$rules);

        $atencionSucursale->update($request->all());

        return redirect()->route('atencion-sucursales.index')
            ->with('success', 'AtencionSucursale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $atencionSucursale = AtencionSucursale::find($id)->delete();

        return redirect()->route('atencion-sucursales.index')
            ->with('success', 'AtencionSucursale deleted successfully');
    }
}
