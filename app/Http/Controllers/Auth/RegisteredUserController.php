<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Manejar la solicitud de registro.
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Datos recibidos del formulario:', $request->all());

        // Validar los datos del formulario con mensajes personalizados
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/',
            ],
            'apellido' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'fecha_nacimiento' => [
                'required',
                'date',
                'before:' . Carbon::now()->subYears(18)->toDateString(),
            ],
            'telefono' => [
                'required',
                'string',
                'size:10',
                'regex:/^[0-9]{10}$/',
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
        ], [
            // Mensajes personalizados para nombre
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede exceder 255 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            // Mensajes personalizados para apellido
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser texto.',
            'apellido.min' => 'El apellido debe tener al menos 3 caracteres.',
            'apellido.max' => 'El apellido no puede exceder 255 caracteres.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',

            // Mensajes personalizados para email
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'email.unique' => 'Este email ya está registrado en el sistema.',
            'email.max' => 'El email no puede exceder 255 caracteres.',

            // Mensajes personalizados para fecha de nacimiento
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before' => 'Debes ser mayor de 18 años para registrarte.',

            // Mensajes personalizados para teléfono
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.size' => 'El teléfono debe tener exactamente 10 dígitos.',
            'telefono.regex' => 'El teléfono solo puede contener números.',

            // Mensajes personalizados para contraseña
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener mayúsculas, minúsculas y números.',
            'password_confirmation.required' => 'La confirmación de contraseña es obligatoria.',
        ]);

        Log::info('Validación exitosa');

        // Determinar el rol basado en el email
        $role = $this->determineRoleFromEmail($request->email);
        Log::info('Rol asignado: ' . $role);

        try {
            // Crear el usuario con los datos validados
            $user = User::create([
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'email' => $validated['email'],
                'fecha_nacimiento' => $validated['fecha_nacimiento'],
                'telefono' => $validated['telefono'],
                'password' => Hash::make($validated['password']),
                'role' => $role,
            ]);

            // Disparar evento de registro
            event(new Registered($user));

            // Autenticar al usuario
            Auth::login($user);

            Log::info('Usuario creado con ID: ' . $user->id . ' y rol: ' . $role);

            // Redirigir según el rol
            return $this->redirectByRole($user);

        } catch (\Exception $e) {
            Log::error('Error al crear usuario: ' . $e->getMessage());

            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['error' => 'Error al registrar el usuario. Por favor, intenta nuevamente.']);
        }
    }

    /**
     * Determinar el rol basado en el email.
     */
    private function determineRoleFromEmail(string $email): string
{
    $email = strtolower(trim($email));

    Log::info("🔍 Determinando rol para email: $email");

    // 🔹 Asignar admin si el correo termina en @admin.com
    if (str_ends_with($email, '@admin.com')) {
        Log::info("✅ Rol asignado: admin (por dominio @admin.com)");
        return 'admin';
    }

    // Detectar rol por palabras clave en la primera parte del correo
    $localPart = explode('@', $email)[0];

    if (str_contains($localPart, 'admin')) {
        Log::info("✅ Rol asignado: admin (por palabra clave)");
        return 'admin';
    }

    if (str_contains($localPart, 'vendedor')) {
        Log::info("✅ Rol asignado: vendedor (por palabra clave)");
        return 'vendedor';
    }

    if (str_contains($localPart, 'inventario')) {
        Log::info("✅ Rol asignado: inventario (por palabra clave)");
        return 'inventario';
    }

    // Dominios especiales
    $domain = explode('@', $email)[1] ?? '';

    // Dominio vendedor
    if (in_array($domain, ['vendedor.com'])) {
        Log::info("✅ Rol asignado: vendedor (por dominio vendedor.com)");
        return 'vendedor';
    }

    // Dominios comunes → cliente
    if (in_array($domain, ['gmail.com','hotmail.com','outlook.com','yahoo.com'])) {
        Log::info("✅ Rol asignado: cliente (dominio común)");
        return 'cliente';
    }

    Log::info("⚠️ Rol cliente asignado por defecto");
    return 'cliente';
}


    /**
     * Redirigir según el rol del usuario.
     */
    private function redirectByRole(User $user): RedirectResponse
    {
        $mensajeRol = match($user->role) {
            'admin' => 'Bienvenido administrador.',
            'vendedor' => 'Bienvenido vendedor.',
            'inventario' => 'Bienvenido al equipo de inventario.',
            default => 'Bienvenido cliente.',
        };

        $ruta = match($user->role) {
            'admin' => 'dashboard.admin',
            'vendedor' => 'dashboard.vendedor',
            'inventario' => 'dashboard.inventario',
            default => 'dashboard.cliente',
        };

        return redirect()->route($ruta)
            ->with('success', 'Cuenta creada con éxito. ' . $mensajeRol);
    }
}