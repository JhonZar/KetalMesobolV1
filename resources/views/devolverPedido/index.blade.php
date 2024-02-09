@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Pedidos del Cliente</h1>

        <form action="{{ route('buscar-pedidos') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="ci" class="form-control" placeholder="Buscar por CI del cliente">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        @if (isset($cliente))
            <div class="mb-4">
                <h2>Cliente: {{ $cliente->nombre }} {{ $cliente->apellido }} (CI: {{ $cliente->ci }})</h2>
            </div>

            @if ($pedidos->count() > 0)
                <ul class="list-group">
                    @foreach ($pedidos as $pedido)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pedido ID: {{ $pedido->id }}, Fecha: {{ $pedido->fecha }}, Estado: {{ $pedido->estado }},
                            Deuda: {{ $pedido->saldo }}
                            @if ($pedido->estado != "VENTA COMPLETA" && $pedido->estado != "ENTREGADO")
                                <button type="button" class="btn btn-primary devolver-btn" data-bs-toggle="modal"
                                    data-bs-target="#ped{{ $pedido->id }}">
                                    Devolver
                                </button>
                            @endif
                        </li>

                        <!-- Modal para cada pedido -->
                        <div class="modal fade modal-lg" id="ped{{ $pedido->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle del PEDIDO</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST"
                                            action="{{ route('cambiarEstadoPedido', ['idPedido' => $pedido->id]) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <!-- Primera columna -->

                                                <div class="col-md-6">
                                                    <strong>TOTAL PRECIO PEDIDO: {{ $pedido->precioTotal }} Bs </strong>
                                                    <P></P>
                                                    <strong>A CUENTA: {{ $pedido->pagoACuenta }} Bs </strong>
                                                    <P></P>
                                                    <strong class="text-danger">DEBE: {{ $pedido->saldo }} Bs </strong>
                                                </div>

                                                <!-- Segunda columna -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="id_estado">Cambiar Estado:</label>
                                                        <select class="form-control" name="id_estado" id="id_estado">
                                                            <option value="ENTREGADO">ENTREGADO</option>
                                                            <option value="ENTREGADO DEUDA">ENTREGADO DEUDA</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="nuevo_saldo">Saldo:</label>
                                                        <input type="number" class="form-control" name="nuevo_saldo" id="nuevo_saldo" placeholder="Nuevo Saldo" max="{{ $pedido->saldo }}">
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Cambiar Estado</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            @else
                <p>No se encontraron pedidos para este cliente.</p>
            @endif
        @endif
    </div>
    <!-- Modal para confirmar devolución -->



@endsection
