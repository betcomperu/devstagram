<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Devstagram - @yield('titulo')</title>
    <!-- Agrega aquí tus enlaces a archivos CSS y JavaScript con @ vite -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles

    <!-- Asegúrate de incluir los estilos de Font Awesome o el set de iconos que prefieras usar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Encabezado -->
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                DevStagram
            </h1>
            @auth
                <!-- Este bloque se muestra solo si el usuario está autenticado -->
                <nav class="flex items-center gap-2">
                    <a
                        href="{{ route('posts.create') }}"
                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                    >
                        <i class="fas fa-plus"></i>
                        Crear
                    </a>

                    <a
                        class="font-bold text-gray-600 text-sm"
                        href="{{ route('dashboard', ['user' => auth()->user()->username]) }}"
                    >
                        Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            @endauth

            @guest
                <!-- Este bloque se muestra solo si el usuario NO está autenticado -->
                <nav class="flex items-center gap-2">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
                </nav>
            @endguest
        </div>
    </header>

    <!-- Cuerpo Principal -->
    <main class="container mx-auto mt-10 flex-grow">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        <div class="container">
            @yield('contenido')
        </div>
    </main>

    <!-- Pie de Página (Opcional) -->
    <footer class="bg-gray-800 text-white py-4">
        <p class="text-center text-sm font-semibold">
            &copy; {{ date('Y') }} Devstagram. Todos los derechos reservados.
        </p>
    </footer>

    <!-- Agrega aquí tus scripts -->
    @livewireScripts <!-- Mueve esto aquí -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
