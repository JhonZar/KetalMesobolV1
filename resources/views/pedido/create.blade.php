@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Pedido
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Pedido</span>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('pedidos.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('pedido.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
