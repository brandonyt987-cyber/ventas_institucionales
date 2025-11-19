<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function enviar(Request $request)
    {
        // VALIDACIONES
        $rules = [
            'mensaje' => 'required|string|max:5000',
        ];

        // Si NO está autenticado, validar nombre/email/telefono desde el formulario
        if (!Auth::check()) {
            $rules['nombre'] = [
                'required',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',
                'min:2',
            ];

            $rules['email'] = 'required|email';

            $rules['telefono'] = [
                'nullable',
                'regex:/^[0-9]{7,15}$/',
            ];
        }

        $validated = $request->validate($rules);

        // Obtener datos dependiendo si está logueado o no
        $nombre   = Auth::check() ? Auth::user()->nombre   : $validated['nombre'];
        $email    = Auth::check() ? Auth::user()->email    : $validated['email'];
        $telefono = Auth::check() ? Auth::user()->telefono : ($validated['telefono'] ?? null);

        // Guardar el mensaje
        ContactMessage::create([
            'user_id'  => Auth::id(),
            'nombre'   => $nombre,
            'email'    => $email,
            'telefono' => $telefono,
            'mensaje'  => $validated['mensaje'],
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}
