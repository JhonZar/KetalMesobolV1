@extends('layouts.app')

@section('template_title')
    {{ $detallePedido->name ?? "{{ __('Show') Detalle Pedido" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Detalle Pedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-pedidos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Pedido:</strong>
                            {{ $detallePedido->id_pedido }}
                        </div>
                        <div class="form-group">
                            <strong>Id Producto:</strong>
                            {{ $detallePedido->id_producto }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $detallePedido->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Precion Unitario:</strong>
                            {{ $detallePedido->precion_unitario }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
