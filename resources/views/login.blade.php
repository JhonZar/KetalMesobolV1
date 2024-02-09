@extends('layouts.app')
@section('template_title')
    Login
@endsection

@section('content')
    <section class="text-center">
        <div class="banner-imagelog w-100 vh-100 d-flex justify-content-center align-items-center img-fluid">
            <div class="container-sm bg-personal text-white justify-content-center">

                <div class="row justify-content-md-center">
                    <div class="col-4"><br><br>
                        <h2>Iniciar Sesión</h2><br><br>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="sucursal">Sucursal</label>
                        <select class="form-select" aria-label="Default select example" name="sucursal" required>
                            <option value="" disabled selected>Selecciona la sucursal</option>
                            @foreach ($sucursal as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="nombre">UserName</label>
                        <input type="text" id="form3Example3" class="form-control" id="nombre" name="nombre" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="contra">Contraseña</label>
                        <input type="password" id="form3Example4" class="form-control" id="contra" name="contra"
                            required />
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Iniciar Sesion
                    </button>
                </form>
                @if ($message = Session::get('success'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif


            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
@endsection
