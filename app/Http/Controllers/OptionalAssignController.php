<?php

namespace App\Http\Controllers;

use App\Model\Student;
use Illuminate\Http\Request;

class OptionalAssignController extends Controller
{
    public function index()
    {
        $students = Student::query()->get();
        return view('optional_assign.index',compact('students'));
    }
}
