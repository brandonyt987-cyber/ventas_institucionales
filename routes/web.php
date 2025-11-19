<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ===============================
// CONTROLADORES
// ===============================
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ContactoController;

use App\Http\Controllers\Cliente\DashboardController as ClienteDashboard;
use App\Http\Controllers\Vendedor\DashboardController as VendedorDashboard;
use App\Http\Controllers\Vendedor\ProductoController as VendedorProductoController;
use App\Http\Controllers\Vendedor\ClienteController as VendedorClienteController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Vendedor\ModoVendedorController;

// ===============================
// 🌐 RUTAS PÚBLICAS
// ===============================
Route::get('/', [HomeController::class, 'index'])->name('inicio');
Route::view('/quienes-somos', 'quienes-somos')->name('quienes-somos');
Route::view('/por-que-elegirnos', 'por-que-elegirnos')->name('por-que-elegirnos');
Route::view('/contacto', 'contacto')->name('contacto');

Route::get('/producto/{id}', [ProductoController::class, 'mostrar'])->name('producto.mostrar');
Route::get('/buscar', [ProductoController::class, 'buscar'])->name('buscar');

// ===============================
// 🛒 CARRITO (Público)
// ===============================
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar/{productoId}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::patch('/carrito/actualizar/{itemId}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{itemId}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// ===============================
// 🔐 POST LOGIN REDIRECT
// ===============================
Route::get('/dashboard', function () {
    if (!Auth::check()) return redirect()->route('login');

    return match (Auth::user()->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'vendedor' => redirect()->route('vendedor.dashboard'),
        'cliente'  => redirect()->route('cliente.dashboard'),
        default    => redirect()->route('login'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// ===============================
// 👤 CLIENTE
// ===============================
Route::middleware(['auth', 'role:cliente'])
    ->prefix('cliente')
    ->name('cliente.')
    ->group(function () {
        Route::get('/dashboard', [ClienteDashboard::class, 'index'])->name('dashboard');
        Route::get('/producto/{id}', [ClienteDashboard::class, 'show'])->name('producto.show');
        Route::post('/cambiar-modo', [ClienteDashboard::class, 'cambiarModo'])->name('cambiarModo');
    });

// ===============================
// 🏪 VENDEDOR
// ===============================
Route::middleware(['auth'])
    ->prefix('vendedor')
    ->name('vendedor.')
    ->group(function () {
        Route::get('/dashboard', [VendedorDashboard::class, 'index'])->name('dashboard');
        Route::post('/cambiar-modo', [VendedorDashboard::class, 'cambiarModo'])->name('cambiarModo');

        // Productos
        Route::get('/productos', [VendedorProductoController::class, 'index'])->name('productos.index');
        Route::get('/productos/crear', [VendedorProductoController::class, 'create'])->name('productos.create');
        Route::post('/productos', [VendedorProductoController::class, 'store'])->name('productos.store');
        Route::get('/productos/{id}/editar', [VendedorProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{id}', [VendedorProductoController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{id}', [VendedorProductoController::class, 'destroy'])->name('productos.destroy');

        // Clientes
        Route::get('/clientes', [VendedorClienteController::class, 'index'])->name('clientes.index');
    });

// ===============================
// 👑 ADMIN
// ===============================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::get('/inventario', [ProductoController::class, 'inventario'])->name('inventario');

        // Usuarios
        Route::get('/usuarios', [AdminUserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{user}/edit', [AdminUserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{user}', [AdminUserController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{user}', [AdminUserController::class, 'destroy'])->name('usuarios.destroy');

        // Productos Admin
        Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    });

// ===============================
// 💳 COMPRAS (Autenticado)
// ===============================
Route::middleware(['auth'])->group(function () {
    Route::post('/compra/procesar', [CompraController::class, 'procesarCompra'])->name('compra.procesar');
    Route::get('/compra/factura/{id}', [CompraController::class, 'factura'])->name('compra.factura');
    Route::get('/compra/factura/{id}/pdf', [CompraController::class, 'descargarPDF'])->name('compra.pdf');
});

// ===============================
// 📬 CONTACTO
// ===============================
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

// ===============================
// 👤 PERFIL (Autenticado)
// ===============================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===============================
// 🔐 AUTENTICACIÓN LARAVEL
// ===============================
require __DIR__.'/auth.php';

// ===============================
// 🔄 MODO VENDEDOR
// ===============================
Route::post('/modo-vendedor-toggle', [ModoVendedorController::class, 'toggle'])
    ->name('modo.vendedor.toggle')
    ->middleware('auth');