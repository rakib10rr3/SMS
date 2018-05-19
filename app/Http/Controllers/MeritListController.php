<?php

namespace App\Http\Controllers;

use App\Model\ExamTerm;
use App\Model\Grade;
use App\Model\Group;
use App\Model\Mark;
use App\Model\MeritList;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
use Illuminate\Http\Request;

class MeritListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $groups = Group::all();
        $exam_terms = ExamTerm::all();

        return view('merit_list.index', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Request
     */
    public function show(Request $request)
    {
        $query = $request->except(['_token']);

        /*
        theclass	"2"
        section	"1"
        shift	"1"
        group	"1"
        session	"2018"
        exam_term	"1"
         */

        /**
         * Check if merit list already generated or not!
         */
        $merit_lists_count = MeritList::query()
            ->where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->count();

        if ($merit_lists_count == 0) {


            /**
             * Steps
             * 1. Query all subjects
             * 2. Check if all subject have marks
             * 3. Sum-up all the subject marks
             * NOTE: if single subject fail the s/he will FAIL
             */

            /**
             * Get All The subjects
             */
            $subjects = Subject::query()
                ->where('the_class_id', $query['theclass'])
                ->where('group_id', $query['group'])
                ->get();

            $is_error = false;
            $subject_list = array();

            /**
             * Check is all subjects marks are submitted!
             */
            foreach ($subjects as $subject) {
                $mark_count = Mark::query()->where('the_class_id', $query['theclass'])
                    ->where('subject_id', $subject->id)
                    ->where('section_id', $query['section'])
                    ->where('shift_id', $query['shift'])
                    ->where('session', $query['session'])
                    ->where('exam_term_id', $query['exam_term'])
                    ->count();

                //echo "1 ";

                if ($mark_count <= 0) {
                    $is_error = true;
                    $subject_list[] = $subject->name;
                }
            }

            /**
             * Give error if all subject marks is not given
             */
            if ($is_error) {
                $classes = TheClass::all();
                $sections = Section::all();
                $shifts = Shift::all();
                $groups = Group::all();
                $exam_terms = ExamTerm::all();

                $error_message = 'Following Subjects marks is not submitted yet: ' . implode(', ', $subject_list);

                return view('merit_list.index', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'query', 'error_message'));
            }

            /**
             * Let's sum-up all the marks
             */

            /**
             * Get the students of the class
             */
            $students = Student::query()->where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('group_id', $query['group'])
                ->get();

            $total_subject = count($subjects);

            $grades = Grade::query()->orderBy('min_value', 'DESC')->get();

            // Getting dynamic Fail id
            $grade_fail_id = Grade::query()->where('name', 'F')->pluck('id')->first();

            foreach ($students as $student) {

//            $total_marks = Mark::query()->where('student_id', $student->id)
//                ->where('session', $query['session'])
//                ->sum('total_marks');

                $total_mark = $student->marks
                    ->where('session', $query['session'])
                    ->sum('total_marks');


                $fail_count = $student->marks
                    ->where('session', $query['session'])
                    ->where('point', 0)
                    ->count();

                $final_grade_point = 0;
                $final_grade_id = $grade_fail_id;

                if ($fail_count == 0) {

                    if ($student->theClass->name == '9' || $student->theClass->name == '10') {
                        /**
                         * NODE: for 9 and 10, optional subject is not counted for calcualting gpa
                         */
                        $final_grade_point = $total_mark / ($total_subject - 1);
                    } else {
                        $final_grade_point = $total_mark / $total_subject;
                    }

                    /**
                     * Grade Point Generator
                     */
                    foreach ($grades as $grade) {
                        if ($total_mark >= $grade->min_value) {
                            $final_grade_id = $grade->id;
                            break;
                        }
                    }

                }

                /**
                 * Create merit list item
                 */
                $merit_list = new MeritList;

                $merit_list->student_id = $student->id;
                $merit_list->the_class_id = $query['theclass'];
                $merit_list->section_id = $query['section'];
                $merit_list->shift_id = $query['shift'];
                $merit_list->session = $query['session'];
                $merit_list->exam_term_id = $query['exam_term'];


                $merit_list->total_marks = $total_mark;
                $merit_list->point = $final_grade_point;
                $merit_list->grade_id = $final_grade_id;

                $merit_list->save();

//            dd($student->id, $total_subject, $total_mark, $merit_list);

            }
        }

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);

        if (!isset($grades)) {
            $grades = Grade::query()->orderBy('min_value', 'DESC')->get();
        }

        $merit_lists = MeritList::query()
            ->where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->get();

        return view('merit_list.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'query', 'merit_lists', 'grades'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\MeritList $meritList
     * @return \Illuminate\Http\Response
     */
//    public function edit(MeritList $meritList)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $query = $request->except(['_token']);

        /*
        theclass	"2"
        section	"1"
        shift	"1"
        group	"1"
        session	"2018"
        exam_term	"1"
         */


        /**
         * Steps
         * 1. Query all subjects
         * 2. Check if all subject have marks
         * 3. Sum-up all the subject marks
         * NOTE: if single subject fail the s/he will FAIL
         */

        /**
         * Get All The subjects
         */
        $subjects = Subject::query()
            ->where('the_class_id', $query['theclass'])
            ->where('group_id', $query['group'])
            ->get();

        $is_error = false;
        $subject_list = array();

        /**
         * Check is all subjects marks are submitted!
         */
        foreach ($subjects as $subject) {
            $mark_count = Mark::query()->where('the_class_id', $query['theclass'])
                ->where('subject_id', $subject->id)
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('session', $query['session'])
                ->where('exam_term_id', $query['exam_term'])
                ->count();

            //echo "1 ";

            if ($mark_count <= 0) {
                $is_error = true;
                $subject_list[] = $subject->name;
            }
        }

        /**
         * Give error if all subject marks is not given
         */
        if ($is_error) {
            $classes = TheClass::all();
            $sections = Section::all();
            $shifts = Shift::all();
            $groups = Group::all();
            $exam_terms = ExamTerm::all();

            $error_message = 'Following Subjects marks is not submitted yet: ' . implode(', ', $subject_list);

            return view('merit_list.index', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'query', 'error_message'));
        }

        /**
         * Let's sum-up all the marks
         */

        /**
         * Get the students of the class
         */
        $students = Student::query()->where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('group_id', $query['group'])
            ->get();

        $total_subject = count($subjects);

        $grades = Grade::query()->orderBy('min_value', 'DESC')->get();

        // Getting dynamic Fail id
        $grade_fail_id = Grade::query()->where('name', 'F')->pluck('id')->first();

        foreach ($students as $student) {

//            $total_marks = Mark::query()->where('student_id', $student->id)
//                ->where('session', $query['session'])
//                ->sum('total_marks');

            $total_mark = $student->marks
                ->where('session', $query['session'])
                ->sum('total_marks');


            if ($student->theClass->name == 'Nine' || $student->theClass->name == 'Ten') {
                $total_point = 0;

                $marks = $student->marks
                    ->where('session', $query['session']);

                $optional_subjects = Subject::query()
                    ->where('is_optional', true)
                    ->pluck('id')
                    ->toArray();


                foreach ($marks as $mark) {
                    /**
                     * If the mark is for a optional subject, then it will be subtracted by 2
                     */
                    if (array_search($mark->subject_id, $optional_subjects)) {
                        $temp_point = $mark->point - 2;
                        if($temp_point > 0)
                        {
                            $total_point += $temp_point;
                        }
                    } else {
                        $total_point += $mark->point;
                    }
                }


            } else {
                $total_point = $student->marks
                    ->where('session', $query['session'])
                    ->sum('point');
            }


            $fail_count = $student->marks
                ->where('session', $query['session'])
                ->where('point', 0)
                ->count();


            $final_grade_point = 0;
            $final_grade_id = $grade_fail_id;

            if ($fail_count == 0) {
                if ($student->theClass->name == '9' || $student->theClass->name == '10') {
                    /**
                     * NODE: for 9 and 10, optional subject is not counted for calculating gpa
                     */
                    $final_grade_point = $total_point / ($total_subject - 1);
                } else {
                    $final_grade_point = $total_point / $total_subject;
                }

                /**
                 * Grade Point Generator
                 */
                foreach ($grades as $grade) {
                    if ($final_grade_point >= $grade->min_point) {
                        $final_grade_id = $grade->id;
                        break;
                    }
                }

            }

            /**
             * Get the merit list item
             */
            $merit_list = $student->meritLists
                ->where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('session', $query['session'])
                ->where('exam_term_id', $query['exam_term'])
                ->first();

//                $merit_list->student_id = $student->id;
//                $merit_list->the_class_id = $query['theclass'];
//                $merit_list->section_id = $query['section'];
//                $merit_list->shift_id = $query['shift'];
//                $merit_list->session = $query['session'];
//                $merit_list->exam_term_id = $query['exam_term'];


            $merit_list->total_marks = $total_mark;
            $merit_list->point = $final_grade_point;
            $merit_list->grade_id = $final_grade_id;

            $merit_list->save();

//            dd($student->id, $total_subject, $total_mark, $merit_list);

        }

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);

        if (!isset($grades)) {
            $grades = Grade::query()->orderBy('min_value', 'DESC')->get();
        }

        $merit_lists = MeritList::query()
            ->where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->get();

        return view('merit_list.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'query', 'merit_lists', 'grades'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\MeritList $meritList
     * @return \Illuminate\Http\Response
     */
//    public function destroy(MeritList $meritList)
//    {
//        //
//    }
}
