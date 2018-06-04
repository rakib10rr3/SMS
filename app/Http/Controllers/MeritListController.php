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
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * Show the Term Results
     *
     * @param Request $request
     * @return Request
     */
    public function show(Request $request)
    {
        $query = $request->except(['_token']);

//        dd($query);

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
//        $merit_lists_count = MeritList::query()
//            ->where('the_class_id', $query['theclass'])
//            ->where('section_id', $query['section'])
//            ->where('shift_id', $query['shift'])
//            ->where('session', $query['session'])
//            ->where('exam_term_id', $query['exam_term'])
//            ->count();
//
//        if ($merit_lists_count == 0) {


        /**
         * Steps
         * 1. Query all subjects
         * 2. Check if all subject have marks
         * 3. Sum-up all the subject marks
         * NOTE: if single subject fail the s/he will FAIL
         */

        /**
         * Get All The subjects by Group
         */
        $subjects = Subject::query()
            ->where('the_class_id', $query['theclass'])
            ->where('group_id', $query['group'])
            ->get();

        /**
         * Class 9 and 10 has some common subject
         */
        if ($query['theclass'] == 9 || $query['theclass'] == 10) {
            $subjects_common = Subject::query()
                ->where('the_class_id', $query['theclass'])
                ->where('group_id', 1)# 1 = None
                ->get();
        }

        $is_error = false;
        $subject_list = array();

        /**
         * Check is all subjects marks are submitted!
         */
        foreach ($subjects as $subject) {
            $mark_count = Mark::query()
                ->where('the_class_id', $query['theclass'])
                ->where('subject_id', $subject->id)
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('session', $query['session'])
                ->where('exam_term_id', $query['exam_term'])
                ->count();

            if (empty($mark_count)) {
                $is_error = true;
                $subject_list[] = $subject->name;
            }
        }

        /**
         * Check other common subjects for 9 and 10
         */
        if ($query['theclass'] == 9 || $query['theclass'] == 10) {
            foreach ($subjects_common as $subject) {
                $mark_count = Mark::query()
                    ->where('the_class_id', $query['theclass'])
                    ->where('subject_id', $subject->id)
                    ->where('section_id', $query['section'])
                    ->where('shift_id', $query['shift'])
                    ->where('session', $query['session'])
                    ->where('exam_term_id', $query['exam_term'])
                    ->count();

                if (empty($mark_count)) {
                    $is_error = true;
                    $subject_list[] = $subject->name;
                }
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

            $error_message = 'Following Subjects Marks is not submitted yet: ' . implode(', ', $subject_list);

            return view('merit_list.index', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'query', 'error_message'));
        }

        /**
         * **********************************************************
         * Let's sum-up all the marks
         * **********************************************************
         */

        /**
         * Get the students of the class
         */
        $students = Student::query()
            ->where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('group_id', $query['group'])
            ->get();
//        return $students;

        $total_subject = count($subjects);

        $grades = Grade::query()->orderBy('min_value', 'DESC')->get();

        // Getting dynamic Fail id
        $grade_fail_id = Grade::query()->where('name', 'F')->pluck('id')->first();

        $optional_subject_id = 0;

        foreach ($students as $student) {

            /**
             * One student can be in one class in one session
             */
            $total_mark = $student->marks
                ->where('session', $query['session'])
                ->where('exam_term_id', $query['exam_term'])
                ->sum('total_marks');

            /**
             * Total Point
             */
            $total_point = 0;
            if ($student->theClass->name == 'Nine' || $student->theClass->name == 'Ten') {

                /**
                 * Get all subject marks
                 */
                $marks = $student->marks
                    ->where('session', $query['session'])
                    ->where('exam_term_id', $query['exam_term']);

                /**
                 * Get the optional subject ID
                 */
                $optional_subject = Subject::query()
                    ->where('is_optional', true)
                    ->where('the_class_id', $query['theclass'])
                    ->where('group_id', $query['group'])
                    ->first(['id']);
//                    ->pluck('id');


                if ($optional_subject != null) {
                    $optional_subject_id = $optional_subject->id;
                }


                foreach ($marks as $mark) {
                    /**
                     * If the mark is for a optional subject, then it will be subtracted by 2
                     */
//                    if (array_search($mark->subject_id, $optional_subjects)) { # with pluck()

                    if ($mark->subject_id == $optional_subject_id) {
                        $temp_point = $mark->point - 2;
                        if ($temp_point > 0) {
                            $total_point += $temp_point;
                        }
                    } else {
                        $total_point += $mark->point;
                    }
                }
            } else {
                $total_point = $student->marks
                    ->where('session', $query['session'])
                    ->where('exam_term_id', $query['exam_term'])
                    ->sum('point');
            }

            $fail_count = $student->marks
                ->where('session', $query['session'])
                ->where('exam_term_id', $query['exam_term'])
                ->where('point', 0)
                ->where('subject_id', '<>', $optional_subject_id)
                ->count();

            Log::debug($fail_count);

            $final_grade_point = 0;
            $final_grade_id = $grade_fail_id;

            if ($fail_count == 0) {

                if ($student->theClass->name == 'Nine' || $student->theClass->name == 'Ten') {
                    /**
                     * NODE: for 9 and 10, optional subject is not counted for calculating gpa
                     */
                    $final_grade_point = $total_point / ($total_subject - 1);
                } else {
                    $final_grade_point = $total_point / $total_subject;
                }

                if ($final_grade_point > 5) {
                    $final_grade_point = 5;
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
             * Check if already merit list exist for the student
             */
            $merit_list = $student->meritLists
                ->where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('session', $query['session'])
                ->where('exam_term_id', $query['exam_term'])
                ->first();

            if (empty($merit_list)) {
                /**
                 * If not exist then create it!
                 */
                $merit_list = new MeritList;

                $merit_list->student_id = $student->id;
                $merit_list->the_class_id = $query['theclass'];
                $merit_list->section_id = $query['section'];
                $merit_list->shift_id = $query['shift'];
                $merit_list->session = $query['session'];
                $merit_list->exam_term_id = $query['exam_term'];
            }

            $merit_list->total_marks = $total_mark;
            $merit_list->point = $final_grade_point;
            $merit_list->grade_id = $final_grade_id;

            $merit_list->save();

        }
//        }

        $class = TheClass::query()->find($query['theclass']);
        $section = Section::query()->find($query['section']);
        $shift = Shift::query()->find($query['shift']);
        $group = Group::query()->find($query['group']);
        $exam_term = ExamTerm::query()->find($query['exam_term']);

//        if (!isset($grades)) {
//            $grades = Grade::query()->orderBy('min_value', 'DESC')->get();
//        }

//        $merit_lists = MeritList::query()
//            ->where('the_class_id', $query['theclass'])
//            ->where('section_id', $query['section'])
//            ->where('shift_id', $query['shift'])
//            ->where('session', $query['session'])
//            ->where('exam_term_id', $query['exam_term'])
//            ->get();

        $merit_lists = Student::query()
            ->select('merit_lists.*', 'students.id as student_id', 'students.name as student_name', 'students.roll as student_roll', 'grades.name as grade_name')
            ->leftJoin('merit_lists', 'merit_lists.student_id', '=', 'students.id')
            ->leftJoin('grades', 'merit_lists.grade_id', '=', 'grades.id')
            ->where('students.the_class_id', $query['theclass'])
            ->where('students.section_id', $query['section'])
            ->where('students.shift_id', $query['shift'])
            ->where('students.group_id', $query['group'])
            ->where('merit_lists.exam_term_id', $query['exam_term'])
            ->get();

//        $merit_lists = MeritList::with(['student' => function ($q) use ($query) {
//            $q->select('id')
//                ->where('the_class_id', $query['theclass'])
//                ->where('section_id', $query['section'])
//                ->where('shift_id', $query['shift'])
//                ->where('group_id', $query['group']);
//        }])
//        ->get();

//        return $merit_lists;
//       dd($merit_lists);


        return view('merit_list.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'query', 'merit_lists', 'grades'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request)
//    {
//        $query = $request->except(['_token']);
//
//        /*
//        theclass	"2"
//        section	"1"
//        shift	"1"
//        group	"1"
//        session	"2018"
//        exam_term	"1"
//         */
//
//
//        /**
//         * Steps
//         * 1. Query all subjects
//         * 2. Check if all subject have marks
//         * 3. Sum-up all the subject marks
//         * NOTE: if single subject fail the s/he will FAIL
//         */
//
//        /**
//         * Get All The subjects
//         */
//        $subjects = Subject::query()
//            ->where('the_class_id', $query['theclass'])
//            ->where('group_id', $query['group'])
//            ->get();
//
//        $is_error = false;
//        $subject_list = array();
//
//        /**
//         * Check is all subjects marks are submitted!
//         */
//        foreach ($subjects as $subject) {
//            $mark_count = Mark::query()->where('the_class_id', $query['theclass'])
//                ->where('subject_id', $subject->id)
//                ->where('section_id', $query['section'])
//                ->where('shift_id', $query['shift'])
//                ->where('session', $query['session'])
//                ->where('exam_term_id', $query['exam_term'])
//                ->count();
//
//            //echo "1 ";
//
//            if ($mark_count <= 0) {
//                $is_error = true;
//                $subject_list[] = $subject->name;
//            }
//        }
//
//        /**
//         * Give error if all subject marks is not given
//         */
//        if ($is_error) {
//            $classes = TheClass::all();
//            $sections = Section::all();
//            $shifts = Shift::all();
//            $groups = Group::all();
//            $exam_terms = ExamTerm::all();
//
//            $error_message = 'Following Subjects marks is not submitted yet: ' . implode(', ', $subject_list);
//
//            return view('merit_list.index', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'query', 'error_message'));
//        }
//
//        /**
//         * Let's sum-up all the marks
//         */
//
//        /**
//         * Get the students of the class
//         */
//        $students = Student::query()->where('the_class_id', $query['theclass'])
//            ->where('section_id', $query['section'])
//            ->where('shift_id', $query['shift'])
//            ->where('group_id', $query['group'])
//            ->get();
//
//        $total_subject = count($subjects);
//
//        $grades = Grade::query()->orderBy('min_value', 'DESC')->get();
//
//        // Getting dynamic Fail id
//        $grade_fail_id = Grade::query()->where('name', 'F')->pluck('id')->first();
//
//        foreach ($students as $student) {
//
////            $total_marks = Mark::query()->where('student_id', $student->id)
////                ->where('session', $query['session'])
////                ->sum('total_marks');
//
//            $total_mark = $student->marks
//                ->where('session', $query['session'])
//                ->sum('total_marks');
//
//            /**
//             * Total Point
//             */
//            $total_point = 0;
//            if ($student->theClass->name == 'Nine' || $student->theClass->name == 'Ten') {
//
//                $marks = $student->marks
//                    ->where('session', $query['session']);
//
//                $optional_subjects = Subject::query()
//                    ->where('is_optional', true)
//                    ->pluck('id')
//                    ->toArray();
//
//
//                foreach ($marks as $mark) {
//                    /**
//                     * If the mark is for a optional subject, then it will be subtracted by 2
//                     */
//                    if (array_search($mark->subject_id, $optional_subjects)) {
//                        $temp_point = $mark->point - 2;
//                        if ($temp_point > 0) {
//                            $total_point += $temp_point;
//                        }
//                    } else {
//                        $total_point += $mark->point;
//                    }
//                }
//            } else {
//                $total_point = $student->marks
//                    ->where('session', $query['session'])
//                    ->sum('point');
//            }
//
//
//            $fail_count = $student->marks
//                ->where('session', $query['session'])
//                ->where('point', 0)
//                ->count();
//
//
//            $final_grade_point = 0;
//            $final_grade_id = $grade_fail_id;
//
//            if ($fail_count == 0) {
//                if ($student->theClass->name == 'Nine' || $student->theClass->name == 'Ten') {
//                    /**
//                     * NODE: for 9 and 10, optional subject is not counted for calculating gpa
//                     */
//                    $final_grade_point = $total_point / ($total_subject - 1);
//                } else {
//                    $final_grade_point = $total_point / $total_subject;
//                }
//
//                /**
//                 * Grade Point Generator
//                 */
//                foreach ($grades as $grade) {
//                    if ($final_grade_point >= $grade->min_point) {
//                        $final_grade_id = $grade->id;
//                        break;
//                    }
//                }
//
//            }
//
//            /**
//             * Get the merit list item
//             */
//            $merit_list = $student->meritLists
//                ->where('the_class_id', $query['theclass'])
//                ->where('section_id', $query['section'])
//                ->where('shift_id', $query['shift'])
//                ->where('session', $query['session'])
//                ->where('exam_term_id', $query['exam_term'])
//                ->first();
//
//            $merit_list->total_marks = $total_mark;
//            $merit_list->point = $final_grade_point;
//            $merit_list->grade_id = $final_grade_id;
//
//            $merit_list->save();
//
////            dd($student->id, $total_subject, $total_mark, $merit_list);
//
//        }
//
//        $class = TheClass::find($query['theclass']);
//        $section = Section::find($query['section']);
//        $shift = Shift::find($query['shift']);
//        $group = Group::find($query['group']);
//        $exam_term = ExamTerm::find($query['exam_term']);
//
//        if (!isset($grades)) {
//            $grades = Grade::query()->orderBy('min_value', 'DESC')->get();
//        }
//
//        $merit_lists = MeritList::query()
//            ->where('the_class_id', $query['theclass'])
//            ->where('section_id', $query['section'])
//            ->where('shift_id', $query['shift'])
//            ->where('session', $query['session'])
//            ->where('exam_term_id', $query['exam_term'])
//            ->get();
//
//        return view('merit_list.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'query', 'merit_lists', 'grades'));
//
//    }

    /**
     * ***************************************************************************
     * *************************[ Final Result Generator ]*******************************
     * ***************************************************************************
     */

//    public function finalIndex()
//    {
//        $classes = TheClass::all();
//        $sections = Section::all();
//        $shifts = Shift::all();
//        $groups = Group::all();
////        $exam_terms = ExamTerm::all();
//
//        return view('merit_list.index_final', compact('classes', 'sections', 'shifts', 'groups', 'is_final_index'));
//
//    }

    /**
     * Show the Term Results
     *
     * @param Request $request
     * @return Request
     */
//    public function finalShow(Request $request)
//    {
//        $query = $request->except(['_token']);
//
//        /*
//        theclass	"1"
//        section	"1"
//        shift	"1"
//        group	"1"
//        session	"2018"
//        */
//
//        /**
//         * Steps
//         * 1. Check All Term Exist
//         * 2. Query all Term Marks
//         * 3. Check all Term Marks exists
//         * 4. Sum-up all the Term Marks
//         * NOTE: if single subject failed in final term then s/he will FAIL
//         */
//
//        /**
//         * Check All Term Exist
//         */
//
//        $terms = ExamTerm::all();
//
//        $is_error = false;
//        $term_list = array();
//
//        foreach ($terms as $term) {
//            $total = MeritList::query()
//                ->where('the_class_id', $query['theclass'])
//                ->where('section_id', $query['section'])
//                ->where('shift_id', $query['shift'])
//                ->where('session', $query['session'])
//                ->where('exam_term_id', $term->id)
//                ->count();
//
//            if (empty($total)) {
//                $is_error = true;
//                $term_list[] = $term->name;
//            }
//        }
//
//        if ($is_error) {
//            $classes = TheClass::all();
//            $sections = Section::all();
//            $shifts = Shift::all();
//            $groups = Group::all();
//
//            $error_message = 'Following Term Marks is not submitted yet: ' . implode(', ', $term_list);
//
//            return view('merit_list.index_final', compact('classes', 'sections', 'shifts', 'groups', 'is_final_index', 'error_message'));
//        }
//
//        return 0;
//
//        /**
//         * Query All Term Marks
//         */
//
//
//        /**
//         * Check all Term Marks exists
//         */
//
//
//        /**
//         * Sum-up all the Term Marks
//         */
//
//
//    }

}
