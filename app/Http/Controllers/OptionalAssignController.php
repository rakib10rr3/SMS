<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Section;
use App\Model\Student;
use App\Model\TheClass;
use Illuminate\Http\Request;

class OptionalAssignController extends Controller
{
    public function index()
    {
        //$students = Student::query()->get();
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        return view('optional_assign.index',compact('classes','groups','sections'));
    }

    public function getData(Request $request){
        //return $request->all();
        $students = Student::query()->where('the_class_id', '=' ,$request->class)->where('group_id', '=' ,$request->group)->where('section_id', '=' ,$request->section)->get();
        //return $students;
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        return view('optional_assign.index',compact('students','classes','groups','sections'));
    }
}
