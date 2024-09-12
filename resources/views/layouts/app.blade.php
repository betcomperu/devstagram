<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Devstagram - @yield('titulo')</title>
    <!-- Agrega aquí tus enlaces a archivos CSS y JavaScript con @ vite -->
     @vite('resources/css/app.css')
     @vite('resources/js/app.js')

</head>
<body class="bg-gray-200 flex flex-col min-h-screen">
    <!-- Encabezado -->
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-4xl font-bold" >Devstagram</h1>
            <nav class="flex gap-2 items-center">

                <a class="font-bold uppercase text-gray-600 text-sm" href="">Login</a></li>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a></li>

            </nav>
            </div>
    </header>

    <!-- Cuerpo Principal -->
    <main class="container mx-auto mt-10 flex-grow">
        <h2 class="font black text-center text-4xl font-bold mb-10">
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
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
