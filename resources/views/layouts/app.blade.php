<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (trim($__env->yieldContent('template_title')))
            @yield('template_title') |
        @endif {{ config('app.name', 'Laravel') }}
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    {{-- link de lo copeado --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('home') }}">Ketal Mesobol</a>

        @if (Session::has('nombre'))
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

                <div class="text-white">
                    <span>Bienvenido {{ session('nombre') }}</span>
                </div>
            </form>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">


                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('carrito') }}" role="button" aria-expanded="false"><i
                            class="fa-solid fa-cart-shopping"></i>
                        {{ count(session('carrito', [])) }}</a>

                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown"
                        href="{{ route('mostrar-modal-notificaciones') }}" 
                        aria-expanded="false">
                        <i class="fa-solid fa-bell"></i>
                        {{ session('notificaciones_sin_leer', 0) }}
                    </a>
                </li>
                



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">...</a></li>
                        <li><a class="dropdown-item" href="#!">...</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Cerrar sesion</a></li>

                    </ul>
                </li>


            </ul>
        @endif



    </nav>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cerrar sisión</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Estas seguro que quieres salir del sistema?...
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Aceptar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




    @if (Session::has('nombre'))
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false"
                                aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Administrador
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a>
                                    <a class="dropdown-item" href="{{ route('clientes.index') }}">Clientes</a>
                                    <a class="dropdown-item" href="{{ route('estados.index') }}">Estados</a>
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                                    <a class="dropdown-item" href="{{ route('sucursales.index') }}">Sucursales</a>
                                    <a class="dropdown-item" href="{{ route('materiales.index') }}">Materiales</a>
                                    <a class="dropdown-item" href="{{ route('colores.index') }}">Colores</a>

                                    <a class="dropdown-item" href="{{ route('empleados.index') }}">Empleados</a>
                                    <a class="dropdown-item" href="{{ route('productos.index') }}">Productos</a>
                                    <a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a>
                                    <a class="dropdown-item" href="{{ route('pedidos.index') }}">Pedidos</a>
                                    <a class="dropdown-item" href="{{ route('inventarios.index') }}">Inventarios</a>
                                    <a class="dropdown-item" href="{{ route('detalle-pedidos.index') }}">Detalle de
                                        pedidos</a>
                                    <a class="dropdown-item"
                                        href="{{ route('destinatarios.index') }}">Destinatarios</a>
                                    <a class="dropdown-item" href="{{ route('historial-estados.index') }}">Historial
                                        de estados</a>
                                    <a class="dropdown-item" href="{{ route('atencion-sucursales.index') }}">Atencion
                                        sucursales</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapsePages" aria-expanded="false"
                                aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                                Ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="dropdown-item" href="{{ route('clientes.index') }}">Clientes</a>
                                    <a class="dropdown-item" href="{{ route('productos.index') }}">Productos</a>
                                    <a class="dropdown-item" href="{{ route('pedidos.index') }}">Pedidos</a>
                                    <a class="dropdown-item" href="{{ route('detalle-pedidos.index') }}">Detalle de
                                        pedidos</a>
                                    <a class="dropdown-item"
                                        href="{{ route('destinatarios.index') }}">Destinatarios</a>
                                    <a class="dropdown-item" href="{{ route('historial-estados.index') }}">Historial
                                        de estados</a>
                                    <a class="dropdown-item" href="{{ route('historial.listar') }}">Tareas
                                        pendientes</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-print"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                        data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                        aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                        data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                        data-bs-target="#pagesCollapseError" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                        data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">General</div>
                            <a class="nav-link" href={{ route('pedidos.index') }}>
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Pedidos
                            </a>
                            <a class="nav-link" href={{ route('pedidos.index') }}>
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Pedidos
                            </a>
                            <a class="nav-link" href="{{ route('devolver-pedido.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Devolver Pedido
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Conectado como: {{ session('sucursal') }}</div>
                        {{ session('nombre') }}

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
    @endif
    <main>
        @yield('content')

    </main>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/scripts.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    
  
</body>

</html>
