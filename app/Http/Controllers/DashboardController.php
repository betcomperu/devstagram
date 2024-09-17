<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa el modelo User
use App\Models\Post; // Asegúrate de importar el modelo Post
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($user)
    {
        $user = auth()->user(); // Obtiene el usuario autenticado
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10); // Obtiene los posts del usuario

        return view('dashboard', compact('posts', 'user')); // Asegúrate de pasar ambas variables
    }
   // app/Http/Controllers/DashboardController.php
public function show($username)
{
    // Busca el usuario por su nombre de usuario
    $user = User::where('username', $username)->firstOrFail(); // Asegúrate de que esto esté correcto
       $posts = Post::where('user_id', $user->id)->latest()->paginate(10);

       return view('dashboard', compact('user', 'posts')); // Asegúrate de pasar ambas variables
}
}
