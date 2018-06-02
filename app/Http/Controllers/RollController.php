<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\MeritList;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\TheClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RollController extends Controller
{
    public function index()
    {
        $classes = TheClass::all(['id', 'name']);
        return view('roll_generate.index', compact('classes'));
    }

//    public function generate(Request $request)
//    {
//        $query = $request->except(['_token']);
//
//        $session = 2018;
//        $exam_term_id = 3;
//
//        $classes = TheClass::all(['id']);
//
//        foreach ($classes as $class) {
//            $sections = Section::all('id');
//
//            foreach ($sections as $section) {
//                $shifts = Shift::all(['id']);
//
//                foreach ($shifts as $shift) {
//
//                    $groups = Group::all(['id']);
//                    foreach ($groups as $group) {
//
//                        $the_class_id = $class->id;
//                        $group_id = $section->id;
//                        $shift_id = $shift->id;
//                        $section_id = $group->id;
//
//                        /*
//                         * Maybe below is correct sql -_-
//                SELECT
//                    students.id AS student_id,
//                    merit_lists.id,
//                    merit_lists.total_marks,
//                    merit_lists.exam_term_id
//                FROM
//                    students
//                LEFT JOIN merit_lists ON students.id = merit_lists.student_id
//                        AND merit_lists.session = 2018
//                        AND merit_lists.the_class_id = 10
//                        AND merit_lists.exam_term_id = 3
//                WHERE
//                    students.the_class_id = 10
//                        AND students.session = 2018
//                        AND students.group_id = 2
//                        AND students.shift_id = 1
//                        AND students.section_id = 1
//                ORDER BY
//                    merit_lists.total_marks
//                         */
//
//                        $students = Student::query()
//                            ->leftJoin('merit_lists', function ($join) use ($exam_term_id, $the_class_id, $session) {
//                                $join->on('merit_lists.student_id', '=', 'students.id')
//                                    ->on('merit_lists.session', '=', DB::raw($session))
//                                    ->on('merit_lists.the_class_id', '=', DB::raw($the_class_id))
//                                    ->on('merit_lists.exam_term_id', '=', DB::raw($exam_term_id));
//                            })
//                            ->where('students.the_class_id', '=', $the_class_id)
//                            ->where('students.session', '=', $session)
//                            ->where('students.group_id', '=', $group_id)
//                            ->where('students.shift_id', '=', $shift_id)
//                            ->where('students.section_id', '=', $section_id)
//                            ->orderBy('merit_lists.total_marks', 'DESC')
//                            ->get(['students.id']);
//
//                        $i = 1;
//                        foreach ($students as $student) {
//                            Student::query()
//                                ->where('id', '=', $student->id)
//                                ->update(['roll' => $i++]);
//                        }
//
//                    }
//
//                }
//            }
//        }
//
//
//        return "success!<br>This page took " . (microtime(true) - LARAVEL_START) . " seconds to render";
//    }

    public function apiGenerateRoll($class, $session)
    {
//        $session = 2018;
        $exam_term_id = 3;

        //$classes = TheClass::all(['id']);

//        foreach ($classes as $class) {
        $sections = Section::all('id');

        foreach ($sections as $section) {
            $shifts = Shift::all(['id']);

            foreach ($shifts as $shift) {

                $groups = Group::all(['id']);
                foreach ($groups as $group) {

                    $the_class_id = $class;
                    $group_id = $section->id;
                    $shift_id = $shift->id;
                    $section_id = $group->id;

                    /*
                     * Maybe below is correct sql -_-
            SELECT
                students.id AS student_id,
                merit_lists.id,
                merit_lists.total_marks,
                merit_lists.exam_term_id
            FROM
                students
            LEFT JOIN merit_lists ON students.id = merit_lists.student_id
                    AND merit_lists.session = 2018
                    AND merit_lists.the_class_id = 10
                    AND merit_lists.exam_term_id = 3
            WHERE
                students.the_class_id = 10
                    AND students.session = 2018
                    AND students.group_id = 2
                    AND students.shift_id = 1
                    AND students.section_id = 1
            ORDER BY
                merit_lists.total_marks
                     */

                    /**
                     * Student is CurrentYear.
                     * But, merit list is from (CurrentYear - 1)
                     */

                    $students = Student::query()
                        ->leftJoin('merit_lists', function ($join) use ($exam_term_id, $the_class_id, $session) {
                            $join->on('merit_lists.student_id', '=', 'students.id')
                                ->on('merit_lists.session', '=', DB::raw($session - 1))
                                ->on('merit_lists.the_class_id', '=', DB::raw($the_class_id))
                                ->on('merit_lists.exam_term_id', '=', DB::raw($exam_term_id));
                        })
                        ->where('students.the_class_id', '=', $the_class_id)
                        ->where('students.session', '=', $session)
                        ->where('students.group_id', '=', $group_id)
                        ->where('students.shift_id', '=', $shift_id)
                        ->where('students.section_id', '=', $section_id)
                        ->orderBy('merit_lists.total_marks', 'DESC')
                        ->get(['students.id']);

                    $i = 1;
                    foreach ($students as $student) {
                        Student::query()
                            ->where('id', '=', $student->id)
                            ->update(['roll' => $i++]);
                    }

                }

            }
        }
//        }

        $result = [
            "success" => true,
            "message" => "Success!",
        ];

        return $result;
    }

//    public function autoGenerate()
//    {
//        $classes = TheClass::query()->get();
//        $groups = Group::query()->get();
//        $sections = Section::query()->get();
//        $shifts = Shift::query()->get();
//        return view('roll_generate.auto', compact('classes', 'groups', 'sections', 'shifts'));
//    }

//    public function getAutoRollList(Request $request)
//    {
//
//        $classes = TheClass::query()->get();
//        $groups = Group::query()->get();
//        $sections = Section::query()->get();
//        $shifts = Shift::query()->get();
//
//
//        $students = Student::query()
//            ->where('the_class_id', '=', $request->the_class_id)
//            ->where('section_id', '=', $request->section_id)
//            ->where('shift_id', '=', $request->shift_id)
//            ->where('group_id', '=', $request->group_id)
//            ->get();
//
//        $i = 1;
//        foreach ($students as $student) {
//            Student::where('id', '=', $student->id)
//                ->update(['roll' => $i++]);
//        }
//
//        $students = Student::query()
//            ->where('the_class_id', '=', $request->the_class_id)
//            ->where('section_id', '=', $request->section_id)
//            ->where('shift_id', '=', $request->shift_id)
//            ->where('group_id', '=', $request->group_id)
//            ->get();
//
////        $students = Student::query()
////            ->where('the_class_id', '=', $request->the_class_id)
////            ->where('section_id', '=', $request->section_id)
////            ->where('shift_id', '=', $request->shift_id)
////            ->get();
//
//        //return $students;
//
//
//        return $students;
//    }

//    public function meritGenerate()
//    {
//        return "koro";
//    }
}
