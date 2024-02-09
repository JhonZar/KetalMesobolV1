@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Destinatario
@endsection

@section('content')
    <section class="content container-fluid">
        <!-- Formulario de búsqueda de clientes -->
        <form class="form-inline" action="{{ route('buscar.clientes') }}" method="GET">
            <div class="form-group mx-sm-3 mb-2">
                <label for="q" class="sr-only">Buscar Cliente:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="q" id="q" value="{{ old('q') }}"
                        placeholder="Buscar cliente">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">{{ __('Clientes Seleccionados') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('eliminarDeseleccionados') }}">
                            @csrf
                            <ul class="list-unstyled">
                                @foreach ($clientes as $cliente)
                                    @if (in_array($cliente->id, session('clientes_seleccionados', [])))
                                        <li class="d-flex justify-content-between align-items-center">
                                            {{ $cliente->nombre }} ({{ $cliente->ci }})
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" name="clientes[]" class="custom-control-input"
                                                    value="{{ $cliente->id }}" checked>
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary">Guardar Selección</button>
                        </form>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Total de clientes seleccionados: {{ count(session('clientes_seleccionados', [])) }}</p>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">{{ __('Clientes No Seleccionados') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('guardarSeleccion') }}">
                            @csrf
                            <ul class="list-unstyled">
                                @foreach ($clientes as $cliente)
                                    @if (!in_array($cliente->id, session('clientes_seleccionados', [])))
                                        @if (session('id_cliee') != $cliente->id)
                                            <li class="d-flex justify-content-between align-items-center">
                                                {{ $cliente->nombre }} ({{ $cliente->ci }})
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="clientes[]" class="custom-control-input"
                                                        value="{{ $cliente->id }}">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary">Guardar Selección</button>
                            <a type="button" class="btn btn-success" href="{{ route('clientes.create') }}">Agregar
                                Clientes</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Destinatario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('destinatarios.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('destinatario.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
