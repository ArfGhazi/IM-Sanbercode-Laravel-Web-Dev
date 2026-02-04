<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function welcome(Request $request)
    {
        $firstName = $request->first_name;
        $lastName = $request->last_name;

        return view('welcome', compact('firstName', 'lastName'));
    }
}

