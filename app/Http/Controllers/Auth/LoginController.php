<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Mostrar el formulario de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Manejar la solicitud de login.
     */
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Buscar al usuario por correo
        $user = User::where('email', $credentials['email'])->first();

        if (! $user) {
            // Usuario no encontrado
            return back()->withErrors(['email' => 'La cuenta con ese correo no existe.'])->withInput();
        }

        // Verificar la contraseña
        if (! Hash::check($credentials['password'], $user->password)) {
            // Contraseña incorrecta
            return back()->withErrors(['password' => 'Credenciales inválidas.'])->withInput();
        }

        // Realizar login
        Auth::login($user, $request->filled('remember'));

        // Redirigir a la página de inicio con mensaje de éxito
        return redirect()->intended(route('dashboard'))->with('success', 'Has iniciado sesión correctamente.');
    }

    /**
     * Manejar la solicitud de logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
