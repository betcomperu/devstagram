<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        //Validacion
        $this->validate($request, [
            'name' => 'required|string|max:60',
            'username' => 'required|min:3|max:20|unique:users,username',
            'email' => 'required|email|max:60|unique:users',
            'password' => 'required'
        ]);

    }
}
