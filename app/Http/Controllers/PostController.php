<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image; // Esta línea debe estar activa y correcta
use App\Models\Like;



use Illuminate\Support\Facades\File; // Agregar para manejo de archivos
use Illuminate\Support\Facades\Auth; // Agregar para autenticación

class PostController extends Controller
{
    /**
     * Constructor del controlador.
     * Se ejecuta automáticamente cuando se crea una instancia de este controlador.
     */

    public function __construct()
    {
        // Aplica el middleware de autenticación a todas las acciones de este controlador.
        $this->middleware('auth')->except(['show', 'index']);
    }

    /**
     * Método para mostrar la página principal o dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retorna la vista 'dashboard'.
        $posts = Post::latest()->paginate(20);
         $user = auth()->user(); // Asegúrate de que el usuario esté autenticado
         return view('dashboard', ['posts' => $posts, 'user' => $user]);
     }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            // Obtener la imagen del request
            $imagen = $request->file('imagen');

            // Generar un nombre único para la imagen
            $nombreArchivo = Str::uuid() . "." . $imagen->extension(); // Asegúrate de que esta línea esté presente

            // Procesar la imagen
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            // Guardar la imagen en el servidor
            $imagenServidor->save(public_path('uploads/' . $nombreArchivo)); // Usa public_path para la ruta

            // Crear el registro del post en la base de datos
            Post::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $nombreArchivo,
                'user_id' => auth()->user()->id
            ]);

            return redirect()->route('posts.index');
        } else {
            return back()->withErrors(['imagen' => 'La imagen no es válida.']);
        }
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $post->user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index');
    }
    // app/Http/Controllers/PostController.php
public function like(Request $request, $postId)
{
    $like = Like::where('user_id', auth()->id())->where('post_id', $postId)->first();

    if ($like) {
        $like->delete(); // Si ya le dio like, lo elimina
    } else {
        Like::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
        ]);
    }

    return back();
}
public function unlike(Request $request, $postId)
{
    $like = Like::where('user_id', auth()->id())->where('post_id', $postId)->first();

    if ($like) {
        $like->delete(); // Si ya le dio like, lo elimina
    }

    return back();
}
}
