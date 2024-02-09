@extends('layouts.app')

@section('template_title')
    {{ $inventario->name ?? "{{ __('Show') Inventario" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Inventario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Producto:</strong>
                            {{ $inventario->id_producto }}
                        </div>
                        <div class="form-group">
                            <strong>Id Usuario:</strong>
                            {{ $inventario->id_usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $inventario->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $inventario->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Transaccion:</strong>
                            {{ $inventario->tipo_Transaccion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
