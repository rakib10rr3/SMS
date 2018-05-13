<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\TheClass;
use Illuminate\Http\Request;

class RollController extends Controller
{
    public function index()
    {
        return view('roll_generate.index');
    }

    public function autoGenerate()
    {
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $shifts = Shift::query()->get();
        return view('roll_generate.auto', compact('classes', 'groups', 'sections', 'shifts'));
    }

    public function getAutoRollList(Request $request)
    {

        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $shifts = Shift::query()->get();

        $students = Student::query()
            ->where('the_class_id', '=', $request->the_class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('shift_id', '=', $request->shift_id)
            ->get();

        $i=1;
        foreach ($students as $student) {
            Student::where('id', '=' ,$student->id)
                ->update(['roll' => $i++]);
        }

//        $students = Student::query()
//            ->where('the_class_id', '=', $request->the_class_id)
//            ->where('section_id', '=', $request->section_id)
//            ->where('shift_id', '=', $request->shift_id)
//            ->get();

        //return $students;


        return view('roll_generate.auto', compact('classes', 'groups', 'sections', 'students', 'shifts'));
    }

    public function meritGenerate()
    {
        return "koro";
    }
}
