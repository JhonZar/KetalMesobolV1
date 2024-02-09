@extends('layouts.app')


@section('template_title')
    Pedido
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @forelse ($notificaciones as $notificacion)
                    <div class="alert alert-info mb-3 position-relative">
                        <strong>Mensaje:</strong> {{ $notificacion->message }}<br>
                        <strong>ID de Producto:</strong> {{ $notificacion->productId }}



                        @if ($notificacion->isRead)
                            <br>
                            <span class="text-muted">Leído hace
                                {{ $notificacion->readAtDiff->format('%d días, %h horas, %i minutos') }}</span>
                        @else
                            <a href="{{ route('marcar-leida', $notificacion->id) }}"
                                class="position-absolute bottom-0 end-0 text-decoration-none text-success read-link">
                                Marcar como leído <i class="fas fa-check-circle"></i>
                            </a>
                        @endif

                    </div>

                @empty
                    <div class="alert alert-warning text-center">
                        No hay notificaciones disponibles.
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <style>
        .read-link {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .alert:hover .read-link {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endsection


<!-- Tus scripts y enlaces a bibliotecas JavaScript... -->
