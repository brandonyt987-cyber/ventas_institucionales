<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboard;
use App\Http\Controllers\CarritoController; // Asegúrate de importar el controlador del carrito
use Illuminate\Support\Facades\Route;

// Rutas del carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar/{productoId}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::patch('/carrito/actualizar/{itemId}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{itemId}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// =====================================================
// 🌐 RUTAS PÚBLICAS (sin autenticación)
// =====================================================
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/quienes-somos', fn() => view('quienes-somos'))->name('quienes-somos');
Route::get('/por-que-elegirnos', fn() => view('por-que-elegirnos'))->name('por-que-elegirnos');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');

// Búsqueda pública (no requiere login)
Route::get('/buscar', [ProductoController::class, 'buscar'])->name('buscar');

// =====================================================
// 🔒 RUTA DE REDIRECCIÓN DESPUÉS DEL LOGIN
// =====================================================
Route::get('/dashboard', function () {
    if (auth()->check()) {  // Verifica si el usuario está autenticado
        $user = auth()->user();  // Obtiene el usuario autenticado

        return match($user->role) {
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
    
    // Ruta para agregar al carrito
    Route::post('/carrito/agregar/{productoId}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
});

// =====================================================
// 🏪 RUTAS DEL VENDEDOR
// =====================================================
Route::middleware(['auth', 'role:vendedor'])->prefix('vendedor')->name('vendedor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('vendedor.dashboard');
    })->name('dashboard');
    
    Route::get('/productos', function () {
        return view('vendedor.productos');
    })->name('productos');
});

// =====================================================
// 👑 RUTAS DEL ADMIN
// =====================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/usuarios', function () {
        return view('admin.usuarios');
    })->name('usuarios');
});

// =====================================================
// 📦 RUTAS DEL INVENTARIO
// =====================================================
Route::middleware(['auth', 'role:inventario'])->prefix('inventario')->name('inventario.')->group(function () {
    Route::get('/dashboard', function () {
        return view('inventario.dashboard');
    })->name('dashboard');
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
require __DIR__.'/auth.php';

// Ruta de productos 
Route::get('/productos', function () {
    return view('productos');  // Aquí debes devolver la vista correspondiente
})->name('productos');
