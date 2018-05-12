<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RollController extends Controller
{
    public function index(){
        return view('roll_generate.index');
    }

    public function autoGenerate(){

        return view('roll_generate.auto');
    }

    public function meritGenerate(){
        return "koro";
    }
}
