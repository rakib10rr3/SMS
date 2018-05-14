<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Section;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
use App\Model\OptionalAssign;
use Illuminate\Http\Request;

class OptionalAssignController extends Controller
{
    public function index()
    {
        //$students = Student::query()->get();
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $optionalSubjects = Subject::query()->where('is_optional', '=', '1')->get();
        return view('optional_assign.index', compact('classes', 'groups', 'sections','optionalSubjects'));
    }

    public function getData(Request $request)
    {
        $optionalSubjects = array();
        //return $request->all();
        $students = Student::query()->where('the_class_id', '=', $request->the_class_id)
            ->where('group_id', '=', $request->group_id)
            ->where('section_id', '=', $request->section_id)
            ->orderBy('roll')
            ->get();
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();

        foreach ($groups as $group) {
            foreach ($group->subjects as $subject) {
                if ($subject->is_optional == true)
                    array_push($optionalSubjects, $subject);
            }
        }
        //$optionalSubjects = $groups->subjects->name;
        //return $optionalSubjects
        //return true;
       // return view('optional_assign.index', compact('students', 'classes', 'groups', 'sections', 'optionalSubjects'));

        return $students;
    }

    public function store(Request $request)
    {
        return $request->all();
        foreach ($request->request as $key => $value) {
            if (is_numeric($key)) {
                OptionalAssign::query()->create([
                    'subject_id' => $value,
                    'student_id' => $key,]);
            }
        }
    }

    public function edit()
    {
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        return view('optional_assign.edit', compact('classes', 'groups', 'sections'));
    }

    public function getStudentDataWithOptionalSubject(Request $request)
    {
        $students = Student::query()->where('the_class_id', '=', $request->class)->where('group_id', '=', $request->group)->where('section_id', '=', $request->section)->get();
        //return $students;
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $subjects = Subject::query()->where('is_optional', '=', '1')->get();
        $optionalSubjects = OptionalAssign::query()->get();

        $optionals = Array();
        foreach ($optionalSubjects as $value) {
            $optionals[$value['student_id']] = $value['subject_id'];
        }

        // $optionalSubjects = Subject::query()->where('is_optional','=','1')->get();
        //return $optionalSubjects;
        return view('optional_assign.edit', compact('students', 'classes', 'groups', 'sections', 'optionals', 'subjects'));
    }

    public function update(Request $request)
    {
        return $request->all();
        foreach ($request->request as $key => $value) {
            if (is_numeric($key)) {
                OptionalAssign::query()->where('student_id', $key)->update(['subject_id' => $value]);
            }
        }
        return redirect('/subjects/optional/edit');
    }

}
