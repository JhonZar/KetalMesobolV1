<?php

namespace App\Http\Controllers;

use App\Models\Colore;
use Illuminate\Http\Request;

/**
 * Class ColoreController
 * @package App\Http\Controllers
 */
class ColoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colores = Colore::paginate();

        return view('colore.index', compact('colores'))
            ->with('i', (request()->input('page', 1) - 1) * $colores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colore = new Colore();
        return view('colore.create', compact('colore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Colore::$rules);

        $colore = Colore::create($request->all());

        return redirect()->route('colores.index')
            ->with('success', 'Colore created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colore = Colore::find($id);

        return view('colore.show', compact('colore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colore = Colore::find($id);

        return view('colore.edit', compact('colore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Colore $colore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colore $colore)
    {
        request()->validate(Colore::$rules);

        $colore->update($request->all());

        return redirect()->route('colores.index')
            ->with('success', 'Colore updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $colore = Colore::find($id)->delete();

        return redirect()->route('colores.index')
            ->with('success', 'Colore deleted successfully');
    }
}
