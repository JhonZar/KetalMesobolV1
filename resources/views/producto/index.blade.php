@extends('layouts.app')

@section('template_title')
    Producto
@endsection

@section('content')

    @if (session()->has('pedido_id')!=null)
        <div class="container">
            <h2 class="mt-4">Productos agregados {{ count(session('carrito', [])) }} -> DEL PEDIDO {{session('pasoNroPed')}} tipo: {{session('tipoSalida')}}</h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-success" href="{{ route('carrito') }}">Realizar Venta</a>
            </div>
            <div class="float-right">
                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                    {{ __('Crear nuevo producto') }}
                </a>
            </div>
            <div class="row">
                @foreach ($productos as $producto)
                
                    @if ($producto->publico == 'pedido' && session('tipoSalida') == 'PEDIDO' && $producto->cantidad>=1)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('imagen/' . $producto->imagen) }}" class="card-img-top product-image"
                                    alt="Imagen del producto">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="card-text">{{ $producto->descripcion }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Categoría: {{ $producto->categoria->nombre }}</li>
                                    <li class="list-group-item">Material: {{ $producto->materiale->nombre }}</li>
                                    <li class="list-group-item">Talla: {{ $producto->talla }}</li>
                                    <li class="list-group-item">Precio: {{ $producto->precio }} Bs</li>
                                    <li class="list-group-item">Stock: {{ $producto->cantidad }} Unidades</li>
                                </ul>
                                <div class="card-footer text-center">
                                    <form action="{{ url('/agregar-al-carrito/' . $producto->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            
                                            <input type="number" name="cantidad" class="form-control" value="1"
                                                min="1" max="{{ $producto->cantidad }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"> Seleccionar <i
                                                        class="fa-solid fa-cart-shopping"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endif
                    @if ($producto->publico == 'si' && session('tipoSalida') == 'VENTA')
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('imagen/' . $producto->imagen) }}" class="card-img-top product-image"
                                    alt="Imagen del producto">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="card-text">{{ $producto->descripcion }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Categoría: {{ $producto->categoria->nombre }}</li>
                                    <li class="list-group-item">Material: {{ $producto->materiale->nombre }}</li>
                                    <li class="list-group-item">Talla: {{ $producto->talla }}</li>
                                    <li class="list-group-item">Precio: {{ $producto->precio }} Bs</li>
                                    <li class="list-group-item">Stock: {{ $producto->cantidad }} Unidades</li>
                                </ul>
                                <div class="card-footer text-center">
                                    <form action="{{ url('/agregar-al-carrito/' . $producto->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" name="cantidad" class="form-control" value="1"
                                                min="1" max="{{ $producto->cantidad }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Agregar al Carrito <i
                                                        class="fa-solid fa-cart-shopping"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">

                                <span id="card_title">
                                    {{ __('Producto') }}
                                </span>

                                <div class="float-right">
                                    <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Create New') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Categoria</th>
                                            <th>Material</th>
                                            <th>Color</th>
                                            
                                            <th>Talla</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Descripcion</th>
                                            <th>Imagen</th>
                                            <th>Publico</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $producto->categoria->nombre }}</td>
                                                <td>{{ $producto->materiale->nombre }}</td>
                                                <td>{{ $producto->color->nombre }}</td>
                                                <td>{{ $producto->talla }}</td>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>{{ $producto->cantidad }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td><img src="{{ asset('imagen/' . $producto->imagen) }}"
                                                        alt="Imagen del producto" height="60px">
                                                </td>
                                                <td>{{ $producto->publico }}</td>
                                            
                                                <td>
                                                    <form action="{{ route('productos.destroy', $producto->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('productos.show', $producto->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('productos.edit', $producto->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! $productos->links() !!}
                </div>
            </div>
        </div>
    @endif
@endsection
