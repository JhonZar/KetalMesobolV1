@extends('layouts.app')

@section('template_title')
    {{ $colore->name ?? "{{ __('Show') Colore" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Colore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('colores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $colore->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
