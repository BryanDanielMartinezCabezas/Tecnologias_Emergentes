<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Buscar la persona con el email proporcionado
        $persona = Persona::where('email', $credentials['email'])->first();

        // Si no se encuentra la persona, redirigir con error (o redirigir a la misma vista)
        if (!$persona) {
            return redirect()->route('login')->withErrors([
                'email' => 'Este usuario no está registrado'
            ]);
        }

        // Verificar si la persona tiene rol de estudiante o profesor
        if (!$persona->estudiante && !$persona->profesor) {
            return redirect()->route('login')->withErrors([
                'email' => 'Solo estudiantes y profesores pueden ingresar'
            ]);
        }

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Autenticación correcta
            // Verificar el rol y redirigir con el mensaje adecuado
            if ($persona->estudiante) {
                session()->flash('message', 'Bienvenido, Estudiante ' . $persona->nombre . '!');
                return redirect('/dashboard-estudiante');
            }
            if ($persona->profesor) {
                session()->flash('message', 'Bienvenido, Profesor ' . $persona->nombre . '!');
                return redirect('/dashboard-profesor');
            }
        }

        // Si las credenciales no son correctas
        return redirect()->route('login')->withErrors([
            'password' => 'Contraseña incorrecta'
        ]);
    }
}
