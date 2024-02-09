@extends('layouts.app')

@section('template_title')
    {{ $atencionSucursale->name ?? "{{ __('Show') Atencion Sucursale" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Atencion Sucursale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('atencion-sucursales.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Usuario:</strong>
                            {{ $atencionSucursale->id_usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Id Sucursal:</strong>
                            {{ $atencionSucursale->id_sucursal }}
                        </div>
                        <div class="form-group">
                            <strong>Fechainicio:</strong>
                            {{ $atencionSucursale->fechaInicio }}
                        </div>
                        <div class="form-group">
                            <strong>Fechafin:</strong>
                            {{ $atencionSucursale->fechaFin }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
