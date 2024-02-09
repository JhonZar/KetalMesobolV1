<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function index()
    {


        $carrito = session('carrito', []);
        $idUsuario = session('usuario_id');

        $fecha = Carbon::now();
        $productos = Producto::all();
        // Obtener los pedidos en estado "CREACIÓN" con sus relaciones "cliente"
        $pedidosCreacion = Pedido::with('cliente')
            ->where(function ($query) {
                $query->where('estado', 'Venta')
                    ->orWhere('estado', 'Pedido');
            })
            ->where('id_usuario', $idUsuario)
            ->where('fecha', $fecha->format('Y-m-d'))
            ->get();

        // Crear un array asociativo para usar en el elemento <select>
        $opciones = [];
        foreach ($pedidosCreacion as $pedido) {
            $nombreCliente = $pedido->cliente->nombre . ' ' . $pedido->cliente->ci;
            $opciones[$pedido->id] = 'Pedido #' . $pedido->id . ' - Cliente: ' . $nombreCliente;
        }
        return view('carrito.index', compact('carrito', 'opciones', 'productos'));
    }

    public function agregar(Request $request, Producto $producto)
    {
        $carrito = session('carrito', []);

        $tipo=session('tipoSalida');
        
        $productoEnCarrito = null;
        foreach ($carrito as $key => $item) {
            if ($item['id'] == $producto->id) {
                $productoEnCarrito = $key;
                break;
            }
        }

        $cantidadDeseada = $request->input('cantidad');

        if ($cantidadDeseada <= 0) {
            // Validación para asegurarse de que la cantidad sea mayor que cero.
            return redirect()->back()->with('error', 'La cantidad debe ser mayor que cero.');
        }

        if ($productoEnCarrito !== null) {
            // Si el producto ya está en el carrito, verifica si la cantidad deseada no supera el stock disponible.
            $cantidadTotal = $carrito[$productoEnCarrito]['cantidad'] + $cantidadDeseada;
            if ($cantidadTotal > $producto->cantidad) {
                return redirect()->back()->with('error', 'La cantidad seleccionada supera el stock disponible.');
            }

            // Actualiza la cantidad
            $carrito[$productoEnCarrito]['cantidad'] = $cantidadTotal;
        } else {
            // Si el producto no está en el carrito, verifica si la cantidad deseada no supera el stock disponible.
            if ($cantidadDeseada > $producto->cantidad) {
                return redirect()->back()->with('error', 'La cantidad seleccionada supera el stock disponible.');
            }

            // Agrega el producto al carrito
            $nuevoProducto = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'cantidad' => $cantidadDeseada,
                'precio_unitario' => $producto->precio, // Aquí puedes obtener el precio unitario del producto

            ];
            $carrito[] = $nuevoProducto;
        }
       
        session(['carrito' => $carrito]);
        if ($tipo == "PEDIDO") {
            return redirect()->route('carrito')->with('success', 'Producto agregado al carrito');
        }


        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // CarritoController.php

    public function eliminar(Request $request, Producto $producto)
    {
        $carrito = session('carrito', []);

        // Encuentra la clave del producto en el carrito
        $clave = array_search($producto->id, array_column($carrito, 'id'));

        // Si se encuentra, elimina el producto del carrito
        if ($clave !== false) {
            unset($carrito[$clave]);
            $carrito = array_values($carrito); // Reindexar el array
            session(['carrito' => $carrito]);
            return redirect()->back()->with('success', 'Producto eliminado del carrito.');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }
    public function carritoVacio(Request $request)
    {

        $pedidoId = $request->input('pedido_id');
        session()->put('pasoNroPed', $pedidoId);
        $pedido = Pedido::find($pedidoId);
        if ($pedido) {
            // Si se encuentra el pedido, obtenemos su estado
            $estadoPedido = $pedido->estado;

            // Guardar el estado del pedido en la sesión con la clave 'tipoSalida'
            session()->put('tipoSalida', $estadoPedido);
            if ($pedidoId) {

                $agregado = 'pedido nro ' . $pedidoId . ' cliente: ' . $request->input('id_cliente');
                session(['pedido_id' => $agregado]);
                
                return redirect()->route('productos.index')
                    ->with('success', 'Pedido seleccionado');
            }
        }

        session()->put('pedido_id', $pedidoId);
        
        return redirect()->route('carrito')
            ->with('success', 'No hay pedidos');
    }
    public function guardarSeleccion(Request $request)
    {
        $clientesSeleccionados = $request->input('clientes', []); // Obtener la lista de clientes seleccionados desde el formulario

        // Obtener la lista actual de clientes seleccionados o inicializarla como un array vacío
        $clientesActuales = session('clientes_seleccionados', []);

        // Combina los nuevos clientes seleccionados con los actuales
        $clientesActualizados = array_merge($clientesActuales, $clientesSeleccionados);



        // Actualiza la sesión con la lista de clientes seleccionados
        session(['clientes_seleccionados' => $clientesActualizados]);

        return redirect()->route('destinatarios.create');
    }
    public function eliminarDeseleccionados()
    {
        $clientesActuales = session('clientes_seleccionados', []);
        $clientesSeleccionados = request('clientes', []);

        // Identifica los clientes deseleccionados (los que están en $clientesActuales pero no en $clientesSeleccionados)
        $clientesDeseleccionados = array_diff($clientesActuales, $clientesSeleccionados);

        // Elimina los clientes deseleccionados de la lista actual
        foreach ($clientesDeseleccionados as $clienteId) {
            $key = array_search($clienteId, $clientesActuales);
            if ($key !== false) {
                unset($clientesActuales[$key]);
            }
        }

        // Actualiza la sesión con la lista de clientes seleccionados actualizada
        session(['clientes_seleccionados' => $clientesActuales]);

        return redirect()->route('destinatarios.create');
    }
}
