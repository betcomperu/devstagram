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
            'name'=> 'required|min:5',
            'username'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            'password_confirmation'=> 'required'
            ]);
    }
}
