<!-- resources/views/PedidosClientes/informacion.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cliente</title>
    <!-- Agregar enlaces a Bootstrap CSS -->
    <!-- En el head de tu documento principal -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/foodhut.css') }}">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    <!-- Nav Bar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#home">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#about">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#gallary">Productos</a>
                </li>
            </ul>
            <a class=" m-auto" href="#">
                <span class="brand-txt">Ketal Mesobol</span>
            </a>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#contact">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('formulario-cliente') }}">Ver mis pedidos</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-primary ml-xl-4">Iniciar Sesion</a>
                        </li>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Header Section -->
    <!-- Header Section -->
    <header id="home" class="header">
        <div class="overlay text-white">
            <div class="container bg-personal">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="text-center">
                            <h1 class="display-4 mb-4">Información del Cliente</h1>
                        </div>
                        <div class="customer-info">
                            <p><strong>Nombre:</strong> {{ $cliente->nombre }} {{ $cliente->apellido }}</p>
                            <p><strong>CI:</strong> {{ $cliente->ci }}</p>
                            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                            <p><strong>Email:</strong> {{ $cliente->email ?: 'N/A' }}</p>
                        </div>
                        <h2 class="mt-5">Pedidos del Cliente</h2>
                        
                        @if (count($pedidos) > 0)
                            
                                @foreach ($pedidos as $pedido)
                                    @if ( $pedido->estado != "VENTA COMPLETA" && $pedido->estado != "ENTREGADO")
                                        
                                    
                                        <strong>ID Pedido:</strong> {{ $pedido->id }},
                                        <strong>Precio Total:</strong> {{ $pedido->precioTotal }},
                                        <strong>Fecha:</strong> {{ $pedido->fecha }}
                                        <strong>Estado:</strong> {{ $pedido->estado }}
                                        <h3 class="mt-3">Estado de tu pedido</h3>
                                        @php
                                            $posicionEstado = array_search($pedido->estado, $nombresEstados);
                                            $totalEstados = count($nombresEstados);
                                            $progreso = $posicionEstado !== false ? (($posicionEstado + 1) / $totalEstados) * 100 : 0;
                                        @endphp
                                        @if ($progreso == 100)
                                            <p class="text-success">Tu pedido está listo para la entrega</p>
                                        @else
                                            <p class="text-warning">Estamos trabajando en tu pedido...</p>
                                        @endif
                                        <div class="progress mt-2">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $progreso }}%;"
                                                aria-valuenow="{{ $progreso }}" aria-valuemin="0"
                                                aria-valuemax="100"><span>{{ $progreso }}%</span> </div>
                                        </div>
                                        @endif
                                @endforeach
                            
                        @else
                            <p class="mt-3">No hay pedidos para este cliente.</p>
                        @endif
                        <div class="text-center mt-3">
                            <a href="{{ route('formulario-cliente') }}" class="btn btn-primary">Volver al
                                formulario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>




    <!-- Agregar script de Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
