@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Colore
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Colore</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('colores.update', $colore->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('colore.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
