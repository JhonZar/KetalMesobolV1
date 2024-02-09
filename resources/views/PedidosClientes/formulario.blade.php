<!-- resources/views/pedidos/formulario.blade.php -->
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

<!-- Cuerpo de tu documento principal -->

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

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




    <header id="home" class="header">
        <div class="overlay text-white text-center">
            <h1 class="mb-4">Formulario de Cliente</h1>
            @if (session('error'))
                <p class="text-danger">{{ session('error') }}</p>
            @endif
            <form action="{{ route('mostrar-informacion') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="ci_cliente">CI del Cliente:</label>
                    <input type="text" class="form-control" name="ci_cliente" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </header>

    <script>
        var nav = document.querySelector('nav');
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 200) {
                nav.classList.add('bg-personal', 'shadow');
            } else {
                nav.classList.remove('bg-personal', 'shadow');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>


</html>
