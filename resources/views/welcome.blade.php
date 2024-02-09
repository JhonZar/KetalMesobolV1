<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ketal Mesobol</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/foodhut.css') }}">


</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Productos</a>
                </li>
            </ul>
            <a class=" m-auto" href="#">
                <span class="brand-txt">Ketal Mesobol</span>
            </a>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contacto</a>
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
            <h1 class="display-2 font-weight-bold my-3">Ketal Mesobol</h1>
            <h2 class="display-4 mb-5">Tu estilo una moda...</h2>
            <a class="btn btn-lg btn-primary" href="#gallary">View Our gallary</a>
        </div>
    </header>


    <!--  About Section  -->
    <div id="about" class="container-fluid wow fadeIn" id="about"data-wow-duration="1.5s">
        <div class="row">
            <div class="col-lg-6 has-img-bg"></div>
            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8 py-5 my-5">
                        <h2 class="mb-4">Sobre Nosotros</h2>
                        <p>Bienvenidos a <b>Ketal Mesobol</b>, donde la tradición y la elegancia convergen para dar vida
                            a sombreros únicos con el sello distintivo de Bolivia.
                            Fundada en 2006, nuestra sombrerería se sumerge en la rica herencia cultural del país,
                            fusionando la artesanía boliviana con la moda contemporánea. Cada sombrero que sale de
                            nuestras manos es una obra maestra cuidadosamente elaborada por artesanos locales que han
                            perfeccionado sus habilidades a lo largo de generaciones. Nos enorgullece ofrecer productos
                            de la más alta calidad, utilizando materiales que reflejan la autenticidad de nuestras
                            raíces y comprometiéndonos con prácticas sostenibles para preservar la belleza natural de
                            Bolivia. En Ketal Mesobol, no solo creamos sombreros, sino que tejemos historias y
                            tradiciones en cada hilo, compartiendo la esencia misma de nuestra cultura a través de
                            nuestras creaciones. ¡Únete a nosotros en este viaje donde la artesanía y la elegancia se
                            encuentran bajo el cálido sol boliviano!</p>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- BLOG Section -->
    <div id="gallary" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
        <h2 class="section-title py-5">NUESTROS PRODUCTOS</h2>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="foods" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    @foreach ($productos as $producto)
                        <div class="col-md-4">
                            <div class="card bg-transparent border my-3 my-md-0">
                                <img src="{{ asset('imagen/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                    class="card-img-top img-fluid" style="object-fit: cover; height: 50vh;">
                                <div class="card-body">
                                    <h1 class="text-center mb-4"><a href="#"
                                            class="badge badge-primary">${{ $producto->precio }}</a></h1>
                                    <h4 class="pt20 pb20">{{ $producto->nombre }}</h4>
                                    <p class="text-white">{{ $producto->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Agrega la paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $productos->links() }}
        </div>
    </div>



    <!-- CONTACT Section  -->
    <div id="contact" class="container-fluid bg-dark text-light border-top wow fadeIn">
        <div class="row">
            <div class="col-md-6 px-0">
                <div style="width: 100%; height: 100%; min-height: 400px">
                    <iframe style="width: 100%; height: 100%; min-height: 400px"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1205.1230718364277!2d-68.2042165!3d-16.4922397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edf12cbf042d3%3A0x80189e92214a5ae6!2sSombreros%20KETAL%20Mesobol%20-%20Rio%20Seco!5e0!3m2!1sen!2sbo!4v1650005256028!5m2!1sen!2sbo"></iframe>

                </div>
            </div>
            <div class="col-md-6 px-5 has-height-lg middle-items">
                <h3>Encuéntranos</h3>
                <p>Sombreros KETAL Mesobol te espera con la mejor selección de sombreros de alta calidad. Estamos
                    ubicados en la encantadora zona de Río Seco, donde combinamos la artesanía tradicional boliviana con
                    diseños modernos y elegantes. Nuestra tienda es más que un lugar para adquirir sombreros; es un
                    espacio donde la artesanía se encuentra con la moda.</p>
                <div class="text-muted">
                    <p><span class="ti-support pr-3"></span>CEL: 73502783</p>
                </div>
            </div>
        </div>
    </div>


    <!-- page footer  -->
    <div class="container-fluid bg-dark text-light has-height-md middle-items border-top text-center wow fadeIn">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-4">
                <h3>EMAIL</h3>
                <p class="text-muted">zelandajhontrax@gmail.com</p>
            </div>
            <div class="col-sm-4">
                <h3>TELÉFONO</h3>
                <p class="text-muted">(+591) 72091695</p>
            </div>
        </div>
    </div>
    
    <div class="bg-dark text-light text-center border-top wow fadeIn">
        <p class="mb-0 py-3 text-muted small">&copy; Copyright
            <script>
                document.write(new Date().getFullYear())
            </script> Hecho por <a href="https://github.com/jhonatanLZ/">JhonatanZarzuri</a>
        </p>
    </div>


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
