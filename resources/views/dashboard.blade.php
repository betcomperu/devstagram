@extends('layouts.app')

@section('titulo')
Perfil de {{ $user->username }}
@endsection

@section('contenido')
<div class="flex flex-col items-center md:flex-row md:justify-center md:items-start mt-10 md:mt-20">
    <div class="w-full max-w-sm md:max-w-md lg:max-w-lg flex flex-col items-center md:items-start md:mr-10">
        <div class="flex flex-col md:flex-row items-center">
            <img src="{{ asset('img/usuario.svg') }}" alt="Imagen de perfil" class="w-32 h-32 md:w-40 md:h-40 rounded-full mb-4 md:mb-0 md:mr-6">
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold mb-2">{{ $user->username }}</h2>
                <div class="text-sm text-gray-500 space-y-1">
                    <p><span class="font-semibold">{{ $posts->count() }}</span> Publicaciones</p>
                    <p><span class="font-semibold">0</span> Seguidores</p>
                    <p><span class="font-semibold">0</span> Siguiendo</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="container mx-auto mt-10 mb-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

    @if($posts->isEmpty())
        <p class="text-gray-600 text-center text-sm font-bold uppercase">
            Aún no hay publicaciones
        </p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($posts as $post)
            <div class="post bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('uploads/' . $post->imagen) }}" alt="{{ $post->titulo }}" class="w-full h-auto object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">
                        <a href="{{ route('user.show', $post->user_id) }}" class="text-gray-800 hover:underline">{{ $post->user->username }}</a>
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $post->titulo }}</p>
                    <p class="text-sm text-gray-600">{{ $post->descripcion }}</p>

                    <!-- Componente de Like -->
                    <livewire:like-button :post="$post" />
                </div>
            </div>
        @endforeach
        </div>
    @endif

    {{ $posts->links() }}
    la paginación -->
</section>
@endsection
