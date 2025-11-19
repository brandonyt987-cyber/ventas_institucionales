<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Método para listar todos los usuarios
    public function index()
    {
        $users = User::all();
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users')); // Envía los usuarios a la vista
    }

    public function create()
    {
        // Esto típicamente devuelve la vista del formulario de creación.
        return view('admin.usuarios.index'); 
    }

        public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|regex:/^[\pL\s]+$/u|min:3|max:255',
            'apellido' => 'required|string|regex:/^[\pL\s]+$/u|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'telefono' => 'required|digits:10',
            'fecha_nacimiento' => [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                $edad = \Carbon\Carbon::parse($value)->age; // Calcular la edad
                if ($edad < 18) {
                    $fail('Debes ser mayor de 18 años para registrarte.');
                }
            },
        ],
        ]);
        
        $role = $this->determineRoleFromEmail($request->email);

      // Actualizar los datos del usuario
    $user->update($request->only(['nombre', 'apellido', 'email', 'telefono', 'fecha_nacimiento']));
    
    // Actualizar el rol
    $user->role = $role;
    $user->save();

    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
}

// Función para determinar el rol basado en el correo
private function determineRoleFromEmail($email)
{
    // Lógica para determinar el rol basado en el dominio o el correo
    if (str_ends_with($email, '@admin.com')) {
        return 'admin';
    } elseif (str_ends_with($email, '@vendedor.com')) {
        return 'vendedor';
    } elseif (str_ends_with($email, '@cliente.com')) {
        return 'cliente';
    } elseif (str_ends_with($email, '@inventario.com')) {
        return 'inventario';
    }

    // Por defecto, asignar cliente si no se puede determinar
    return 'cliente';
}
public function destroy(User $user)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $user->delete();

    return redirect()->route('admin.usuarios.index')
                    ->with('success', 'Usuario eliminado correctamente');
}



    // Aquí irían los métodos create(), store(), edit(), update(), destroy() para el CRUD
}