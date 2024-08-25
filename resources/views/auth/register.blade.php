@extends('layouts.app')

@section('titulo', 'Registro Usuario')

@section('contenido')

<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-10">


            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de Registro">


    </div>
    <div class="md:w-1/3 bg-white p-6 rounded-lg">

        @if ($errors->any())
    <div class="alert alert-danger text-red-800">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold" for="nombre">Nombre</label>
                <input
                id="name"
                name="name"
                type="text"
                placeholder="Ingresa tu Nombre"
                value= "{{ old('name') }}"
                class="border p-3 w-full rounded-lg placeholder-gray-400 text-gray @error('name') border-red-500 @enderror" />

                {{-- @error('name')
                <div class="bg-red-100 border text-red-800 text-left p-2">{{ $message }}</div>
                @enderror --}}
            </div>

            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                <input
                id="username"
                name="username"
                type="text"
                placeholder="Ingresa tu usuario"
                value= "{{ old('username') }}"
                class="border p-3 w-full rounded-lg placeholder-gray-400 text-gray" />
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input
                id="email"
                name="email"
                type="email"
                placeholder="Ingresa tu Email de registro"
                value= "{{ old('email') }}"
                class="border p-3 w-full rounded-lg placeholder-gray-400 text-gray" />
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input
                id="password"
                name="password"
                type="password"
                placeholder="Password de registro"
                
                class="border p-3 w-full rounded-lg placeholder-gray-400 text-gray" />
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Password</label>
                <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Repite tu Password"
                class="border p-3 w-full rounded-lg placeholder-gray-400 text-gray" />
            </div>

            <input
            type="submit"
            value="Crear Cuenta"
            class="bg-blue-600 hover:bg-blue-500 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg  " />

        </form>

    </div>

</div>


@endsection
