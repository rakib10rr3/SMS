<?php

namespace App\Http\Controllers;

use App\Model\ExamTerm;
use App\Model\Group;
use App\Model\Mark;
use App\Model\MeritList;
use App\Model\Preference;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Subject;
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
        $groupFlag = "";
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

    public function student_select()
    {

        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $shifts = Shift::query()->get();
        $examTerms = ExamTerm::query()->get();

        //$students = Student::query()->limit(10)->get();
        return view('print.student_select', compact('classes', 'groups', 'sections', 'shifts', 'examTerms'));

    }

    public function student_show(Request $request)
    {

        $class_id = $request->get('the_class_id');
        $group_id = $request->get('group_id');
        $section_id = $request->get('section_id');
        $shift_id = $request->get('shift_id');
        $exam_term_id = $request->get('exam_term');
        $session = $request->get('session_year');

        //dd($class_id,$subject_id,$section_id);
        $query = Student::query();
        /*
                Group
                       1 - None
                       2 - Science
                       3 - Commerce
*                      4 - Arts
         */


        $query = $query->where('group_id', $group_id);

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

        $students = $query->get();

        return $students;

//		$class_name   = TheClass::find( $class_id )->name;
//		$group_name   = Group::find( $group_id )->name;
//		$section_name = Section::find( $section_id )->name;
//		$shift_name   = Shift::find( $shift_id )->name;
//
//		$school_name = Preference::query()->where( 'key', 'institute_name' )->first();;
//		$address = Preference::query()->where( 'key', 'address' )->first();;
//		$exam_term = ExamTerm::find( $exam_term_id )->name;
//
//		return view( 'print.student_show', compact( 'groupFlag', 'class_name', 'group_name', 'section_name', 'shift_name', 'students', 'school_name', 'address', 'exam_term', 'session' ) );

    }

    public function student_print(Request $request)
    {
        $checkbox = $request->get('checkbox');
        $exam_term_id = $request->get('exam_term');
        $school_name = Preference::query()->where('key', 'institute_name')->first();;
        $address = Preference::query()->where('key', 'address')->first();;
        $exam_term = ExamTerm::find($exam_term_id)->name;
        //---------------------------------------
        $group_id = "";
        $the_class_id = "";
        $shift_id = "";
        $section_id = "";

        if (is_array($checkbox)) {

            $student_array = array();
            $student_array2 = array();

            foreach ($checkbox as $key => $value) {
                array_push($student_array2, $value);
                $student = Student::find($value);
                $group_id = $student->group_id;
                $group_name = $student->group->name;
                $the_class_id = $student->the_class_id;
                $class_name = $student->theClass->name;
                $shift_id = $student->shift_id;
                $shift_name = $student->shift->name;
                $section_id = $student->section_id;
                $section_name = $student->section->name;
                $session = $student->session;
            }

            $subjects = Subject::query()->where('the_class_id', $the_class_id)->where('group_id', $group_id)->get();
            /**
             * passing all important ID's
             */
            $all_id=array();
            $all_id['group_id']=$group_id;
            $all_id['the_class_id']=$the_class_id;
            $all_id['shift_id']=$shift_id;
            $all_id['section_id']=$section_id;

            /*
             * Going through each subject and saving their highest value in array
             */
            $highest_mark = array();
            foreach ($subjects as $subject) {

                $marks = Mark::query()->where('exam_term_id', $exam_term_id)->where('the_class_id', $the_class_id)->where('subject_id', $subject->id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
                $value = 0;
                foreach ($marks as $mark) {
                    $temp_value = $mark->written + $mark->mcq + $mark->practical;
                    if ($temp_value > $value) {
                        $value = $temp_value;
                    }
                }
                $highest_mark[$subject->id] = $value;
            }

            /**
             *  Going through each Student Id and saving them as objects
             */
            foreach ($student_array2 as $id) {
                $student = Student::find($id);
                array_push($student_array, $student);
            }

            $students = Mark::whereIn('student_id', $student_array2)->where('exam_term_id', $exam_term_id)->where('the_class_id', $the_class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
            $merit_lists=MeritList::query()->where('exam_term_id', $exam_term_id)->where('the_class_id', $the_class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();

            return view('print.report_card', compact('students', 'school_name', 'address', 'exam_term', 'student_array', 'class_name', 'group_name', 'section_name', 'shift_name', 'session', 'highest_mark','merit_lists','all_id'));

        } else {


        }
    }
}
