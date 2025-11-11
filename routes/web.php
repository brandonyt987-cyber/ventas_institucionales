<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboard;
use App\Http\Controllers\Vendedor\VendedorProductoController;

// =====================================================
// 🌐 RUTAS PÚBLICAS (sin autenticación)
// =====================================================

// Página principal con productos desde la base de datos
Route::get('/', [HomeController::class, 'index'])->name('inicio');

Route::get('/quienes-somos', fn() => view('quienes-somos'))->name('quienes-somos');
Route::get('/por-que-elegirnos', fn() => view('por-que-elegirnos'))->name('por-que-elegirnos');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/producto/{id}', [App\Http\Controllers\ProductoController::class, 'mostrar'])->name('producto.mostrar');


// Búsqueda pública de productos
Route::get('/buscar', [ProductoController::class, 'buscar'])->name('buscar');

// =====================================================
// 🛒 RUTAS DEL CARRITO (accesibles para todos)
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
    if (auth()->check()) {
        $user = auth()->user();

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
    Route::get('/carrito', fn() => view('cliente.carrito'))->name('carrito');
});

// =====================================================
// 🏪 RUTAS DEL VENDEDOR
// =====================================================
Route::middleware(['auth', 'role:vendedor'])->prefix('vendedor')->name('vendedor.')->group(function () {
    Route::get('/dashboard', fn() => view('vendedor.dashboard'))->name('dashboard');

    // Gestión de productos del vendedor
    Route::get('/productos', [VendedorProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [VendedorProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [VendedorProductoController::class, 'store'])->name('productos.store');
});

// =====================================================
// 👑 RUTAS DEL ADMIN
// =====================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/usuarios', fn() => view('admin.usuarios'))->name('usuarios');
});

// =====================================================
// 📦 RUTAS DEL INVENTARIO
// =====================================================
Route::middleware(['auth', 'role:inventario'])->prefix('inventario')->name('inventario.')->group(function () {
    Route::get('/dashboard', fn() => view('inventario.dashboard'))->name('dashboard');
});

// =====================================================
// 👤 RUTAS DE PERFIL (para todos los usuarios autenticados)
// =====================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// 🔐 RUTAS DE AUTENTICACIÓN (login, registro, etc.)
// =====================================================
require __DIR__ . '/auth.php';

// =====================================================
// 📦 RUTA DE LISTADO GENERAL DE PRODUCTOS
// =====================================================
Route::get('/productos', function () {
    return view('productos');
})->name('productos');

use Illuminate\Http\Request;

Route::post('/contacto/enviar', function (Request $request) {
    // Validación simple
    $request->validate([
        'nombre' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'mensaje' => 'required|string|max:1000',
    ]);

    // Aquí podrías enviar un correo o guardar el mensaje, si quisieras
    return back()->with('success', '¡Gracias por tu mensaje! Te responderemos pronto.');
})->name('contacto.enviar');


//carrito no se 
Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->group(function () {
    Route::post('/carrito/agregar/{productoId}', [CarritoController::class, 'agregar'])
        ->name('cliente.carrito.agregar');

    Route::get('/carrito', [CarritoController::class, 'index'])
        ->name('cliente.carrito');
        });

        //ruta vendedor ventas
        Route::middleware(['auth', 'role:vendedor'])->group(function () {
    Route::get('/vendedor/dashboard', [App\Http\Controllers\Vendedor\DashboardController::class, 'index'])->name('vendedor.dashboard');
    Route::get('/vendedor/productos', [App\Http\Controllers\Vendedor\ProductoController::class, 'index'])->name('vendedor.productos.index');
    Route::get('/vendedor/productos/crear', [App\Http\Controllers\Vendedor\ProductoController::class, 'create'])->name('vendedor.productos.create');
    
    // 🔹 Agregamos esta para evitar el error
    Route::get('/vendedor/ventas', function () {
        return view('vendedor.ventas'); // puedes crear esta vista luego
    })->name('vendedor.venta');
});
