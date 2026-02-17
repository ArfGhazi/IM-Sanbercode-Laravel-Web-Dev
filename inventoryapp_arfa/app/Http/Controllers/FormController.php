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
        return view('welcome',[
            'first_name' => $request->first_name ?? '',
            'last_name' => $request->last_name ?? '',
            'gender' => $request->gender ?? '',
            'nationality' => $request->nationality ?? '',
            'language' => $request->language ?? [],
            'bio' => $request->bio ?? ''
        ]);
    }
}
