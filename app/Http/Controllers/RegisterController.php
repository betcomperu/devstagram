<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // Validación de los datos enviados por el usuario
        $this->validate($request, [
            // El nombre debe ser un string con un máximo de 60 caracteres
            'name' => 'required|string|max:60',
            // El username debe ser un string con un mínimo de 3 caracteres y un máximo de 20 caracteres, y debe ser único en la tabla users
            'username' => 'required|min:3|max:20|unique:users,username',
            // El email debe ser un correo electrónico válido con un máximo de 60 caracteres, y debe ser único en la tabla users
            'email' => 'required|email|max:60|unique:users|email:rfc,dns',
            // La contraseña debe ser un string con un mínimo de 6 caracteres y debe coincidir con el campo password_confirmation
            'password' => 'required|string|min:6|confirmed'
        ]);

        try {
            // Crear un nuevo usuario en la base de datos
            $user = User::create([
                // Asignar el nombre del usuario
                'name' => $request->name,
                // Asignar el username del usuario
                'username' => $request->username,
                // Asignar el email del usuario
                'email' => $request->email,
                // Asignar la contraseña del usuario (encriptada con Hash::make)
                'password' => Hash::make($request->password),
            ]);

            // Autenticar al usuario recién creado
            auth()->login($user);

            // Redirigir al usuario a la ruta posts.index con un mensaje de éxito
            return redirect()->route('posts.index')->with('success', 'Cuenta creada con éxito');
        } catch (\Exception $e) {
            // Manejar el error al crear la cuenta
            // Redirigir al usuario a la página anterior con un mensaje de error
            return redirect()->back()->with('error', 'Error al crear cuenta');
        }
    }
}
