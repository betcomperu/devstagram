<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login');
    }


    public function store(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
        return back()->with('mensaje', 'Credenciales Incorrectas');
    }

    // Asegúrate de que el usuario autenticado tiene un username
    $username = auth()->user()->username;

    // Redirige al perfil del usuario usando su nombre de usuario
    return redirect()->route('user.show', ['username' => $username]); // Cambia 'dashboard' a 'user.show'
}
}

/**
 * Explicación del código:
 *
 * 1. El método 'index()' simplemente muestra la vista del formulario de login.
 *
 * 2. El método 'store(Request $request)' maneja el proceso de inicio de sesión:
 *    - Primero, valida que el email y la contraseña hayan sido proporcionados.
 *    - Luego, intenta autenticar al usuario con Auth::attempt().
 *    - Auth::attempt() recibe los credenciales (email y password) y un booleano para "recordar" al usuario.
 *    - Si la autenticación falla, redirige de vuelta al formulario con un mensaje de error.
 *    - Si la autenticación es exitosa, redirige al usuario a la página de posts.
 *
 * 3. La funcionalidad "recordarme" está implementada con $request->remember.
 *    Si el checkbox está marcado, esto será true y Laravel mantendrá la sesión por un período más largo.
 *
 * 4. Se usa el helper 'auth()' para obtener el usuario autenticado y su nombre de usuario para la redirección.
 *
 * 5. Este controlador asume que tienes una ruta nombrada 'posts.index' que acepta el nombre de usuario como parámetro.
 */
