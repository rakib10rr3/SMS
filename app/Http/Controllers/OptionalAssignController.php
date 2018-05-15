<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Section;
use App\Model\Shift;
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
        $shifts = Shift::query()->get();
        $optionalSubjects = Subject::query()->where('is_optional', '=', '1')->get();
        $optionalSubjects = OptionalAssign::query()->get();

        $optionals = Array();
        foreach ($optionalSubjects as $value) {
            $optionals[$value['student_id']] = $value['subject_id'];
        }
        return view('optional_assign.index', compact('classes', 'groups', 'sections', 'optionalSubjects', 'subjects','shifts'));
    }

    public function getData(Request $request)
    {
        // $optionalSubjects = array();
        //return $request->all();
        $students = Student::query()->where('the_class_id', '=', $request->the_class_id)
            ->where('group_id', '=', $request->group_id)
            ->where('section_id', '=', $request->section_id)
            ->orderBy('roll')
            ->get();
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $optionalSubjects = Subject::query()->where('is_optional', '=', '1')->get();
        foreach ($students as $student) {
//            foreach ($optionalSubjects as $optionalSubject) {
//                if ($optionalSubject[$student->id] === $student->id)
//                    $student['optional'] = $optionalSubject->id;
//                else{
//                    $student['optional'] = "No optional Subject ";
//
//                }
            if (empty($student->optionalAssign))
                $student['optional'] = 'No optional subject!';
            else
                $student['optional'] = $student->optionalAssign->subject->name;
        }
        //return ($optionalSubjects);

//        foreach ($groups as $group) {
//            foreach ($group->subjects as $subject) {
//                if ($subject->is_optional == true)
//                    array_push($optionalSubjects, $subject);
//            }
//        }


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
        $students = Student::query()->where('the_class_id', '=', $request->the_class_id)->where('group_id', '=', $request->group_id)->where('section_id', '=', $request->section_id)->where('shift_id', '=', $request->shift_id)->get();
        //return $students;
//        $classes = TheClass::query()->where('id','=',$request->the_class_id)->get();
//        $groups = Group::query()->get();
//        $sections = Section::query()->get();
        $subjects = Subject::query()->where('is_optional', '=', '1')->get();
        $optionalSubjects = OptionalAssign::query()->get();

        $optionals = Array();


        foreach ($optionalSubjects as $optionalSubject) {
            $optionals[$optionalSubject['student_id']] = $optionalSubject['subject_id'];
        }
        //return $optionals;
        return view('optional_assign.edit', compact('students', 'optionals', 'subjects', 'optionalSubjects'));
    }

    public function update(Request $request)
    {
        // return $request->all();
        foreach ($request->request as $key => $value) {
            if (is_numeric($key)) {

               // $data = array('student_id' => $key, 'subject_id' => $value);
//                $found = OptionalAssign::query()->where('student_id', $key)->first();
//
//                if ($found)
//                    OptionalAssign::query()->where('student_id', $key)->update(['subject_id' => $value]);
//                else
//                    OptionalAssign::query()->create(['student_id', $key, 'subject_id' => $value]);

                OptionalAssign::query()->updateOrCreate(['student_id'=>$key],[ 'subject_id'=>$value]);

                // OptionalAssign::query()->updateOrCreate('student_id', $key)->where('student_id', $key)->updateOrCreate(['subject_id' => $value]);
            }
        }
        return redirect('/subjects/optional');
    }

    public function assign()
    {
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $optionalSubjects = Subject::query()->where('is_optional', '=', '1')->get();
        return view('optional_assign.index', compact('classes', 'groups', 'sections', 'optionalSubjects'));
    }

}
