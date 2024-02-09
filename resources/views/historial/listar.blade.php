<!-- resources/views/historial/listar.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Historiales de Pedidos</h1>

    @foreach ($historiales as $key => $historial)
        <div class="card mb-4">
            <div class="card-body">
                <p class="card-text">Descripción: {{ $historial->descripcion }}</p> {{$historial->id}}
                <p class="card-text">Fecha: {{ $historial->fecha }}</p>
                <p class="card-text">Estado Actual: {{ $historial->estado->nombre }}</p>

                <form method="POST" action="{{ route('historial.cambiarEstado', ['idHistorial' => $historial->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_estado">Cambiar Estado:</label>
                        <select class="form-control" name="id_estado" id="id_estado">
                            @foreach ($estadosDisponibles as $estado)
                                @if ($key < count($historiales) - 1 || $estado->id != $historial->estado->id)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cambiar Estado</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
