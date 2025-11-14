<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboard;
use App\Http\Controllers\Vendedor\DashboardController as VendedorDashboard;
use App\Http\Controllers\Vendedor\ProductoController as VendedorProductoController;
use App\Http\Controllers\Vendedor\ClienteController as VendedorClienteController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// =====================================================
// 🌐 RUTAS PÚBLICAS (sin autenticación)
// =====================================================
Route::get('/', [HomeController::class, 'index'])->name('inicio');
Route::get('/quienes-somos', fn() => view('quienes-somos'))->name('quienes-somos');
Route::get('/por-que-elegirnos', fn() => view('por-que-elegirnos'))->name('por-que-elegirnos');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/producto/{id}', [ProductoController::class, 'mostrar'])->name('producto.mostrar');
Route::get('/buscar', [ProductoController::class, 'buscar'])->name('buscar');

// =====================================================
// 🛒 RUTAS DEL CARRITO
// =====================================================
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar/{productoId}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::patch('/carrito/actualizar/{itemId}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{itemId}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// =====================================================
// 🔐 REDIRECCIÓN DESPUÉS DEL LOGIN
// =====================================================
Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'vendedor' => redirect()->route('vendedor.dashboard'),
            'inventario' => redirect()->route('inventario.dashboard'),
            'cliente' => redirect()->route('cliente.dashboard'),
            default => redirect()->route('login'),
        };
    }

    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

// =====================================================
// 👤 RUTAS DEL CLIENTE
// =====================================================
Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/dashboard', [ClienteDashboard::class, 'index'])->name('dashboard');
    Route::get('/producto/{id}', [ClienteDashboard::class, 'show'])->name('producto.show');
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
    Route::post('/carrito/agregar/{productoId}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    
    // ⭐ CAMBIAR MODO - Solo para clientes
    Route::post('/cambiar-modo', [ClienteDashboard::class, 'cambiarModo'])->name('cambiarModo');
});

// =====================================================
// 🏪 RUTAS DEL VENDEDOR
// ⭐ SIN RESTRICCIÓN DE ROL - Cualquier usuario autenticado puede acceder
// =====================================================
Route::middleware(['auth'])->prefix('vendedor')->name('vendedor.')->group(function () {
    Route::get('/dashboard', [VendedorDashboard::class, 'index'])->name('dashboard');
    Route::post('/cambiar-modo', [VendedorDashboard::class, 'cambiarModo'])->name('cambiarModo');

    // Productos
    Route::get('/productos', [VendedorProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [VendedorProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [VendedorProductoController::class, 'store'])->name('productos.store');

    // Clientes
    Route::get('/clientes', [VendedorClienteController::class, 'index'])->name('clientes.index');
});

// =====================================================
// 👑 RUTAS DEL ADMIN
// =====================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    
    Route::get('/usuarios', [AdminUserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{user}/edit', [AdminUserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}', [AdminUserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [AdminUserController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

// =====================================================
// 📦 RUTAS DEL INVENTARIO
// =====================================================
Route::middleware(['auth', 'role:inventario'])->prefix('inventario')->name('inventario.')->group(function () {
    Route::get('/dashboard', fn() => view('inventario.dashboard'))->name('dashboard');
});

// =====================================================
// 👤 PERFIL DE USUARIO
// =====================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// 📬 FORMULARIO DE CONTACTO
// =====================================================
Route::post('/contacto/enviar', function (Request $request) {
    $request->validate([
        'nombre' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'mensaje' => 'required|string|max:1000',
    ]);

    return back()->with('success', '¡Gracias por tu mensaje! Te responderemos pronto.');
})->name('contacto.enviar');

// =====================================================
// 🔐 AUTH
// =====================================================
require __DIR__ . '/auth.php';

use App\Http\Controllers\Auth\LoginController;
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
