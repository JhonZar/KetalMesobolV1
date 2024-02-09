<?php

use App\Http\Controllers\AtencionSucursaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColoreController;
use App\Http\Controllers\DestinatarioController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\DevolverPedController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HistorialEstadoController;
use App\Http\Controllers\HistorialPedidoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MaterialeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidosClientesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SucursaleController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VistasPublicasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [VistasPublicasController::class, 'mostrarProductos'])->name("home");




Route::middleware(['verify.session.fields:usuario_id,nombre'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('estados', EstadoController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('sucursales', SucursaleController::class);
    Route::resource('materiales', MaterialeController::class);
    Route::resource('colores', ColoreController::class);
    
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('productos', ProductoController::class);
    
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('inventarios', InventarioController::class);
    Route::resource('detalle-pedidos', DetallePedidoController::class);
    Route::resource('destinatarios', DestinatarioController::class);
    Route::resource('historial-estados', HistorialEstadoController::class);
    Route::resource('atencion-sucursales', AtencionSucursaleController::class);

    //rutas funciones extras 
    Route::get('/buscar-clientes', [PedidoController::class, 'buscarClientes'])->name('buscar.clientes');

    // parte carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
    Route::post('/agregar-al-carrito/{producto}', [CarritoController::class, 'agregar']);
    Route::post('/agregar-al-carrito',[CarritoController::class, 'carritoVacio'])->name('vacio');
    // web.php
    Route::delete('/eliminar-del-carrito/{producto}', [CarritoController::class,'eliminar']);
    
    Route::post('/guardar-seleccion', [CarritoController::class,'guardarSeleccion'])->name('guardarSeleccion');
    Route::post('/eliminar-deseleccionados',  [CarritoController::class,'eliminarDeseleccionados'])->name('eliminarDeseleccionados');


    Route::get('/historial-pedidos', [HistorialPedidoController::class, 'listarHistorialesPorUsuario'])->name('historial.listar');
    Route::put('/historial-pedidos/{idHistorial}/cambiar-estado', [HistorialPedidoController::class, 'cambiarEstado'])->name('historial.cambiarEstado');

    // Ruta para procesar el cierre de sesión
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    // rutas extras el de busqueda 
    Route::get('/devolver-pedido', [DevolverPedController::class, 'index'])->name('devolver-pedido.index');
Route::get('/buscar-pedidos', [DevolverPedController::class, 'buscarPedidosPorCI'])->name('buscar-pedidos');
Route::put('/pedido/cambiarEstado/{idPedido}', [DevolverPedController::class, 'cambiarEstadoPedido'])->name('cambiarEstadoPedido');

//RUTAS PARA MOSTRAR LAS NOTIFICACIONES
Route::get('/mostrar-modal-notificaciones', [NotificacionController::class, 'mostrarModalConNotificaciones'])->name('mostrar-modal-notificaciones');

Route::get('/marcar-leida/{id}', [NotificacionController::class, 'marcarLeida'])->name('marcar-leida');






});

Route::middleware(['check.session.data'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');

    // Ruta para procesar el formulario de inicio de sesión
    Route::post('login', [LoginController::class, 'login'])->name('login');
    // Otras rutas protegidas aquí
});


Route::get('/formulario-cliente', [PedidosClientesController::class, 'mostrarFormulario'])->name('formulario-cliente');
Route::post('/mostrar-informacion', [PedidosClientesController::class, 'mostrarInformacionCliente'])->name('mostrar-informacion');
///////////////////////
