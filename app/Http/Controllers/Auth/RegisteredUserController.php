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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Log para ver qué llega
        Log::info('Datos recibidos del formulario:', $request->all());

        // Validar los datos del formulario (usando los nombres correctos)
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'fecha_nacimiento' => 'required|date|before:today',
            'telefono' => 'required|string|size:10',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Log::info('Validación exitosa');

        // Asignar rol automáticamente según el email
        $role = $this->determineRoleFromEmail($request->email);
        Log::info('Rol asignado: ' . $role);

        // Crear el usuario con el rol asignado
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        Log::info('Usuario creado con ID: ' . $user->id);

        // Disparar evento de registro
        event(new Registered($user));

        // Redirigir al login con mensaje de éxito
        return redirect()->route('login')
            ->with('success', 'Cuenta creada con éxito. Tu rol es: ' . $role . '. Por favor inicia sesión.');
    }

    /**
     * Determinar el rol basado en el email
     */
        private function determineRoleFromEmail(string $email): string
        {
            // Convertir a minúsculas y limpiar espacios
            $email = strtolower(trim($email));

            Log::info("🔍 Determinando rol para email: $email");

            // OPCIÓN 1: Emails exactos (más seguro)
            $rolesMap = [
                'admin@admin.com' => 'admin',
                'vendedor@vendedor.com' => 'vendedor',
                'inventario@inventario.com' => 'inventario',
            ];

            if (isset($rolesMap[$email])) {
                Log::info("✅ Rol asignado por email exacto: " . $rolesMap[$email]);
                return $rolesMap[$email];
            }

            // OPCIÓN 2: Detectar por palabras clave en cualquier parte del email
            if (str_contains($email, 'admin')) {
                Log::info("✅ Rol asignado: admin (por palabra clave)");
                return 'admin';
            }

            if (str_contains($email, 'vendedor')) {
                Log::info("✅ Rol asignado: vendedor (por palabra clave)");
                return 'vendedor';
            }

            if (str_contains($email, 'inventario')) {
                Log::info("✅ Rol asignado: inventario (por palabra clave)");
                return 'inventario';
            }

            // OPCIÓN 3: Detectar por dominio
            $atPosition = strpos($email, '@');
            if ($atPosition !== false) {
                $domain = substr($email, $atPosition + 1);
                Log::info("📧 Dominio extraído: $domain");

                // Dominios de clientes
                $dominiosClientes = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com'];
                if (in_array($domain, $dominiosClientes)) {
                    Log::info("✅ Rol asignado: cliente (dominio común)");
                    return 'cliente';
                }
            }

            // Por defecto, cliente
            Log::info("✅ Rol asignado: cliente (por defecto)");
            return 'cliente';
        }
}
