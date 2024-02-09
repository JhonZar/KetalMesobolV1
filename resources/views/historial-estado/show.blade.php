@extends('layouts.app')

@section('template_title')
    {{ $historialEstado->name ?? "{{ __('Show') Historial Estado" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Historial Estado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('historial-estados.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Estado:</strong>
                            {{ $historialEstado->id_estado }}
                        </div>
                        <div class="form-group">
                            <strong>Id Pedido:</strong>
                            {{ $historialEstado->id_pedido }}
                        </div>
                        <div class="form-group">
                            <strong>Id Usuarios:</strong>
                            {{ $historialEstado->id_usuarios }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $historialEstado->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
