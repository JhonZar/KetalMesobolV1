@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Historial Estado
@endsection

@section('content')
    



    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Historial Estado</span>
                    </div>
                    <div class="card-body">

                        <div class="accordion" id="accordionPedidos">
                            @foreach ($pedidosEnProceso as $pedido)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $pedido->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $pedido->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $pedido->id }}">
                                            Pedido ID: {{ $pedido->id }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $pedido->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $pedido->id }}" data-bs-parent="#accordionPedidos">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>
                                                        <strong>Cliente:</strong> {{ $pedido->Cliente->nombre }} {{ $pedido->Cliente->apellido }} (CI:
                                                        {{ $pedido->Cliente->ci }})
                                                        <!-- Agrega más detalles del pedido según sea necesario -->
                                                    </p>
                                                    @if (isset($destinatariosPorPedido[$pedido->id]))
                                                        <ul class="list-group">
                                                            @foreach ($destinatariosPorPedido[$pedido->id] as $destinatario)
                                                                <li class="list-group-item">
                                                                    <strong>Destinatario ID:</strong> {{ $destinatario->id }}<br>
                                                                    <strong>Cliente:</strong> {{ $destinatario->cliente->nombre }}<br>
                                                                    <strong>Producto:</strong> {{ $destinatario->producto->nombre }}<br>
                                                                    <strong>Cantidad:</strong> {{ $destinatario->cantidad }}<br>
                                                                    <strong>Fecha de Entrega:</strong> {{ $destinatario->fecha_Entrega }}
                                                                    <!-- Agrega más detalles del destinatario según sea necesario -->
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- Formulario para crear HistorialEstado -->
                                                    <form method="POST" action="{{ route('historial-estados.store') }}" role="form">
                                                        @csrf
                                                        @include('historial-estado.form')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    


    @endsection




