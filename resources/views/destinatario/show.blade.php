@extends('layouts.app')

@section('template_title')
    {{ $destinatario->name ?? "{{ __('Show') Destinatario" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Destinatario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('destinatarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Pedido:</strong>
                            {{ $destinatario->id_pedido }}
                        </div>
                        <div class="form-group">
                            <strong>Id Cliente:</strong>
                            {{ $destinatario->id_cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Id Producto:</strong>
                            {{ $destinatario->id_producto }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $destinatario->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Entrega:</strong>
                            {{ $destinatario->fecha_Entrega }}
                        </div>
                        <div class="form-group">
                            <strong>Talla:</strong>
                            {{ $destinatario->talla }}
                        </div>
                        <div class="form-group">
                            <strong>Obs:</strong>
                            {{ $destinatario->obs }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
