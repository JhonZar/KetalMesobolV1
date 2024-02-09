<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Colore;
use App\Models\Inventario;
use App\Models\Materiale;
use App\Models\Pedido;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate();
        $pasoNroPed = session('pasoNroPed');
        $pedido = Pedido::all();
         return view('producto.index', compact('productos', 'pasoNroPed', 'pedido'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }
    public function galeria()
    {
        $producto = Producto::paginate();
    }



    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        $miArreglo = ['2 1/2', '3', '3 1/2', '4', '4 1/2', '5', '5 1/2', '6', '6 1/2', '7'];
        $pub=['si','no','pedido'];
        $miArregloT = ['CUERO','ESPONJA','ESPONJA CON SELLO','ESPONJA DELGADO','CUERINA NEGRO','PLASTICO','CARTON'];
        
        $categoria = Categoria::pluck('nombre', 'id');
        $material = Materiale::pluck('nombre', 'id');
        $color=Colore::pluck('nombre','id');

        return view('producto.create', compact('producto', 'categoria', 'material', 'miArreglo','color','miArregloT','pub'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Producto::$rules);
        $filName = time() . "." . $request->imagen->extension();
        $request->imagen->move(public_path("imagen"), $filName);

        $producto = new Producto();
        $producto->id_categoria = $request->input('id_categoria');
        
        $producto->idColor = $request->input('idColor');
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->descripcion = $request->input('descripcion');
        $producto->publico = $request->input('publico');
        $producto->idMaterial = $request->input('idMaterial');
        $producto->imagen = $filName;
        $producto->tafilete = $request->input('tafilete');
        $producto->talla = $request->input('talla');

        $producto->save();
        if (!$producto->camtidad > 0) {
            $tipoTransaccion = 'INCREMENTO';
        } else {
            $tipoTransaccion = 'DECREMENTO';
        }

        $cantidad = 0;

        $inventario = new Inventario();
        $inventario->id_producto = $producto->id;
        $inventario->id_usuario = session('usuario_id');
        $inventario->fecha = now();
        $inventario->cantidad = $producto->cantidad;
        $inventario->tipo_Transaccion = $tipoTransaccion;
        $inventario->save();
        return redirect()->route('productos.index')
            ->with('success', 'Producto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $miArreglo = ['2 1/2' => '2 1/2', '3' => '3', '3 1/2' => '3 1/2', '4' => '4', '4 1/2' => '4 1/2', '5' => '5', '5 1/2' => '5 1/2', '6' => '6', '6 1/2' => '6 1/2', '7' => '7'];
        $miArregloT = ['CUERO' => 'CUERO', 'ESPONJA' => 'ESPONJA', 'ESPONJA CON SELLO' => 'ESPONJA CON SELLO', 'ESPONJA DELGADO' => 'ESPONJA DELGADO', 'CUERINA NEGRO' => 'CUERINA NEGRO', 'PLASTICO' => 'PLASTICO', 'CARTON' => 'CARTON'];
        $pub = ['si' => 'si', 'no' => 'no', 'pedido' => 'pedido'];
        
        
        $categoria = Categoria::pluck('nombre', 'id');
        $material = Materiale::pluck('nombre', 'id');
        $color=Colore::pluck('nombre','id');
        return view('producto.edit', compact('producto', 'categoria', 'material', 'miArreglo','color','pub','miArregloT'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        // Define las reglas de validación, comenzando con las reglas del modelo
        $rules = Producto::$rules;

        // Cambia la regla de validación del campo imagen a nullable solo si no se proporciona una nueva imagen
        if (!$request->hasFile('imagen')) {
            $rules['imagen'] = 'nullable|image';
        }

        // Valida los campos utilizando las reglas definidas
        $request->validate($rules);
        $cantidadAnterior=$producto->cantidad;
        // Actualiza los campos del modelo con los valores del formulario
        $producto->id_categoria = $request->input('id_categoria');
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->descripcion = $request->input('descripcion');
        $producto->publico = $request->input('publico');
        $producto->idMaterial = $request->input('idMaterial');
        $producto->talla = $request->input('talla');
        $producto->tafilete = $request->input('tafilete');

        // Actualiza la imagen solo si se proporciona una nueva imagen
        if ($request->hasFile('imagen')) {
            $filName = time() . "." . $request->imagen->extension();
            $request->imagen->move(public_path("imagen"), $filName);
            $producto->imagen = $filName;
        }

        
        $nuevaCantidad=$request->input('cantidad');
        // Guarda los cambios en el modelo
        $producto->save();
        
        $diferencia=$nuevaCantidad-$cantidadAnterior;
        if ($diferencia>0) {
            $tipoTransaccion='INCREMENTO';
        }elseif ($diferencia<0) {
            $tipoTransaccion='DECREMENTO';
        }else {
            $tipoTransaccion='SIN CAMBIOS';
        }
        if ($diferencia !== 0) {
            $inventario = new Inventario();
            $inventario->id_producto = $producto->id;
            $inventario->id_usuario = session('usuario_id');
            $inventario->fecha = now();
            $inventario->cantidad = $diferencia; // Valor absoluto de la diferencia
            $inventario->tipo_Transaccion = $tipoTransaccion;
            $inventario->save();
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }
}
