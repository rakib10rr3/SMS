<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //
    public function index()
    {
        return view('recovery_password.index');
    }

    public function update(Request $request)
    {

    }
}
