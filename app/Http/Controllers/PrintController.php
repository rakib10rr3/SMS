<?php

namespace App\Http\Controllers;

use App\Model\ExamTerm;
use App\Model\Group;
use App\Model\MeritList;
use App\Model\Preference;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\TheClass;
use Illuminate\Http\Request;

class PrintController extends Controller
{

    public function select()
    {
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $shifts = Shift::query()->get();
        $examTerms = ExamTerm::query()->get();
        //$students = Student::query()->limit(10)->get();
        return view('print.select', compact('classes', 'groups', 'sections', 'shifts', 'examTerms'));
    }

    public function show(Request $request)
    {


        //dd($request);
        $class_id = $request->get('the_class_id');
        $group_id = $request->get('group_id');
        $section_id = $request->get('section_id');
        $shift_id = $request->get('shift_id');
        $exam_term_id = $request->get('exam_term');
        $session = $request->get('session_year');

        //dd($class_id,$subject_id,$section_id);
        $query = MeritList::query();

        /*
                Group
                       1 - None
                       2 - Science
                       3 - Commerce
*                      4 - Arts
         */
        $groupFlag="";
        if ($group_id > 1) {
            $groupFlag = "on";
        } else {
            $groupFlag = "off";
        }

        if (!$class_id == null) {
            $query = $query->where('the_class_id', $class_id);
        }
        if (!$section_id == null) {
            $query = $query->where('section_id', $section_id);
        }
        if (!$shift_id == null) {
            $query = $query->where('shift_id', $shift_id);
        }
        if (!$exam_term_id == null) {
            $query = $query->where('exam_term_id', $exam_term_id);
        }
        if (!$session == null) {
            $query = $query->where('session', $session);
        }
        $query = $query->orderBy('total_marks');
        $students = $query->get();



        $class_name = TheClass::find($class_id)->name;
        $group_name = Group::find($group_id)->name;
        $section_name = Section::find($section_id)->name;
        $shift_name = Shift::find($shift_id)->name;

        $school_name = Preference::query()->where('key', 'institute_name')->first();;
        $address = Preference::query()->where('key', 'address')->first();;
        $exam_term = ExamTerm::find($exam_term_id)->name;

        return view('print.show', compact('groupFlag', 'class_name', 'group_name', 'section_name', 'shift_name', 'students', 'school_name', 'address', 'exam_term', 'session'));
    }

    public function fail(){
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $shifts = Shift::query()->get();
        $examTerms = ExamTerm::query()->get();
        //$students = Student::query()->limit(10)->get();
        return view('print.fail', compact('classes', 'groups', 'sections', 'shifts', 'examTerms'));
    }

    public function showFail(Request $request){

        $class_id = $request->get('the_class_id');
        $group_id = $request->get('group_id');
        $section_id = $request->get('section_id');
        $shift_id = $request->get('shift_id');
        $exam_term_id = $request->get('exam_term');
        $session = $request->get('session_year');

        //dd($class_id,$subject_id,$section_id);

        $students = Student::query()
            ->where('group_id',$group_id)
            ->get();
        return $students;

        $students = MeritList::query()
            ->where('the_class_id',$class_id)
            ->where('section_id',$section_id)
            ->where('shift_id',$shift_id)
            ->where('exam_term_id',$exam_term_id)
            ->where('session',$session)
            ->get();
        return $students;

        /*
                Group
                       1 - None
                       2 - Science
                       3 - Commerce
*                      4 - Arts
         */
        $groupFlag="";
        if ($group_id > 1) {
            $groupFlag = "on";
        } else {
            $groupFlag = "off";
        }

        if (!$class_id == null) {
            $query = $query->where('the_class_id', $class_id);
        }
        if (!$section_id == null) {
            $query = $query->where('section_id', $section_id);
        }
        if (!$shift_id == null) {
            $query = $query->where('shift_id', $shift_id);
        }
        if (!$exam_term_id == null) {
            $query = $query->where('exam_term_id', $exam_term_id);
        }
        if (!$session == null) {
            $query = $query->where('session', $session);
        }
        $query = $query->orderBy('total_marks');
        $students = $query->get();



        $class_name = TheClass::find($class_id)->name;
        $group_name = Group::find($group_id)->name;
        $section_name = Section::find($section_id)->name;
        $shift_name = Shift::find($shift_id)->name;

        $school_name = Preference::query()->where('key', 'institute_name')->first();;
        $address = Preference::query()->where('key', 'address')->first();;
        $exam_term = ExamTerm::find($exam_term_id)->name;

        return view('print.fail_list', compact('groupFlag', 'class_name', 'group_name', 'section_name', 'shift_name', 'students', 'school_name', 'address', 'exam_term', 'session'));
    }
}
