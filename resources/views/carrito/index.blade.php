@extends('layouts.app')

@section('template_title')
    Carrito
@endsection

@section('content')
    <div class="container">
        <button onclick="window.history.back()" class="btn btn-secondary">Volver Atrás</button>

        <h1 class="mt-4">Carrito de Compras</h1>

        @if (count($carrito) > 0)
            <!-- En la vista del carrito -->
            <ul class="list-group mt-4">


                @php
                    $precioTotalCarrito = 0; // Inicializamos la variable para el precio total del carrito
                @endphp

                @foreach ($carrito as $producto)
                    @php
                        $precioTotalProducto = $producto['precio_unitario'] * $producto['cantidad'];
                        $precioTotalCarrito += $precioTotalProducto;
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $producto['nombre'] }}
                        <span class=" badge-primary badge-pill">Bs {{ $producto['precio_unitario'] }}</span>
                        <span class=" badge-secondary badge-pill">Cantidad: {{ $producto['cantidad'] }}</span>
                        <span class=" badge-success badge-pill">Total: Bs {{ $precioTotalProducto }} </span>
                       
                        <form action="{{ url('/eliminar-del-carrito/' . $producto['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
                @php
                    session(['precioTotalCarrito' => $precioTotalCarrito]);
                @endphp
                <!-- Mostrar el precio total del carrito al final de la lista de productos -->
                <div class="text-right mt-3">
                    <h3><strong>Total del Carrito: Bs. {{ $precioTotalCarrito }} </strong></h3>
                </div>


            </ul>
            <a href="{{ route('productos.index') }}" class="btn btn-success">Agregar productos</a>

            @if (session('tipoSalida') == 'PEDIDO')
                <a href="{{ route('destinatarios.create') }}" class="btn btn-success">Terminar transaccion</a>
            @else
                <a href="{{ route('detalle-pedidos.create') }}" class="btn btn-success">Terminar transaccion</a>
            @endif
        @else
            <p class="mt-4">El carrito está vacío.</p>
            <p class="mt-4">Elija el número de <b>pedido</b> para poder agregar al carrito.</p>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Agregar el select de pedidos aquí -->
            <form action="{{ route('vacio') }}" method="post" class="form-inline">
                @csrf
                <select name="pedido_id" class="form-control">
                    @foreach ($opciones as $pedido_id => $opcion)
                        <option value="{{ $pedido_id }}">{{ $opcion }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary ml-2">Agregar productos</button>
            </form>
        @endif
    </div>
@endsection
