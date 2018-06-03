<?php

namespace App\Http\Controllers;

use App\Model\ExamTerm;
use App\Model\Grade;
use App\Model\Group;
use App\Model\Mark;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
use Illuminate\Http\Request;

class MarkController extends Controller
{

    /**
     * Query to get the list to add data
     */
    public function query()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $groups = Group::all();
        $exam_terms = ExamTerm::all();
        $subjects = Subject::query()
            ->where('the_class_id', $classes->first()->id)
            ->where('group_id', $groups->first()->id)
            ->get();

        return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects'));
    }

    /**
     * Return the list to add data
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $query = $request->except(['_token']);

        /*
        "_token" => "eqbC62WzmrdZBowWmahZd8qPjyvaFqYSdqtfmPGC"
        "theclass" => "1"
        "section" => "1"
        "shift" => "1"
        "group" => "1"
        "session" => "2018"
        "subject" => "705"
        "exam_term" => "1"
         */

        /**
         * Check if data already exist
         */

        $check_result = Mark::query()
            ->where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->count();

        if ($check_result > 0) {
            $classes = TheClass::all();
            $sections = Section::all();
            $shifts = Shift::all();
            $groups = Group::all();
            $exam_terms = ExamTerm::all();
            $subjects = Subject::query()
                ->where('the_class_id', $query['theclass'])
                ->where('group_id', $query['group'])
                ->get();

            $error_message = "Marks already added to this subject.";

            return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects', 'error_message', 'query'));
        }

        /**
         * End Check
         */

        // dd($query);

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);
        $subject = Subject::find($query['subject']);

        $grades = Grade::orderBy('min_value', 'DESC')->get();

        if($query['group'] == 1)
        {
            $students = Student::where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->get();
        } else {
            $students = Student::where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('group_id', $query['group'])
                ->get();
        }

        $disable_form = true;

        return view('mark.add', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'students', 'disable_form', 'grades'));

    }

    /**
     * Store the added data
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = $request->except(['_token', '_method']);

        /*
        array:11 [▼
        "theclass" => "1"
        "section" => "1"
        "shift" => "1"
        "group" => "1"
        "session" => "2018"
        "subject" => "723"
        "exam_term" => "1"
        "written" => array:28 [▶]
        "mcq" => array:28 [▶]
        "practical" => array:28 [▶]
        "absent" => array:1 [▶]
        ]
         */

        /**
         * Check if data already exist
         */

        $check_result = Mark::query()
            ->where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->count();

        if ($check_result > 0) {
            $classes = TheClass::all();
            $sections = Section::all();
            $shifts = Shift::all();
            $groups = Group::all();
            $exam_terms = ExamTerm::all();
            $subjects = Subject::query()
                ->where('the_class_id', $classes->first()->id)
                ->where('group_id', $groups->first()->id)
                ->get();

            $error_message = "Marks already added to this class.";

            return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects', 'error_message', 'query'));
        }

        /**
         * End Check
         */

        // dd($query);

        $subject = Subject::find($query['subject']);

        $grades = Grade::orderBy('min_value', 'DESC')->get();

        // Getting dynamic Fail id
        $grade_fail_id = Grade::where('name', 'F')->pluck('id')->first();

        if($query['group'] == 1)
        {
            $students = Student::where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->get();
        } else {
            $students = Student::where('the_class_id', $query['theclass'])
                ->where('section_id', $query['section'])
                ->where('shift_id', $query['shift'])
                ->where('group_id', $query['group'])
                ->get();
        }

        foreach ($students as $student) {
            /**
             * Create a mark element
             */
            $mark = new Mark;

            $mark->student_id = $student->id;
            $mark->the_class_id = $query['theclass'];
            $mark->section_id = $query['section'];
            $mark->shift_id = $query['shift'];
            $mark->session = $query['session'];
            $mark->exam_term_id = $query['exam_term'];

            $mark->subject_id = $query['subject'];

            if (isset($query['absent'][$student->id])) {
                $mark->absent = true;

                $mark->written = 0;
                $mark->mcq = 0;
                $mark->practical = 0;

                $mark->total_marks = 0;

                $mark->grade_id = $grade_fail_id;
                $mark->point = 0;
            } else {
                $mark_written = 0;
                $mark_mcq = 0;
                $mark_practical = 0;

                if (isset($query['written'])) {
                    $mark_written = is_numeric($query['written'][$student->id]) ? $query['written'][$student->id] : 0;
                }

                if (isset($query['mcq'])) {
                    $mark_mcq = is_numeric($query['mcq'][$student->id]) ? $query['mcq'][$student->id] : 0;
                }

                if (isset($query['practical'])) {
                    $mark_practical = is_numeric($query['practical'][$student->id]) ? $query['practical'][$student->id] : 0;
                }

                $mark->written = $mark_written;
                $mark->mcq = $mark_mcq;
                $mark->practical = $mark_practical;

                $mark_total = floatval($mark_written) + floatval($mark_mcq) + floatval($mark_practical);

                $mark->total_marks = $mark_total;

                /**
                 * Check if student failed in portion of a subject
                 */
                $is_fail = false;

                if ($subject->has_written) {
                    if ($mark_written < $subject->written_pass_marks) {
                        $is_fail = true;
                    }
                }

                if ($subject->has_mcq) {
                    if ($mark_mcq < $subject->mcq_pass_marks) {
                        $is_fail = true;
                    }
                }

                if ($subject->has_practical) {
                    if ($mark_practical < $subject->practical_pass_marks) {
                        $is_fail = true;
                    }
                }

                $final_grade_point = 0;
                $final_grade_id = $grade_fail_id;


                if ($is_fail != true) {
                    /**
                     * Grade Point Generator
                     */
                    foreach ($grades as $grade) {
                        if ($mark_total >= $grade->min_value) {
                            $final_grade_point = $grade->min_point;
                            $final_grade_id = $grade->id;
                            break;
                        }
                    }
                }

                $mark->grade_id = $final_grade_id;
                $mark->point = $final_grade_point;

            }

            $mark->save();

        }

        // for view
        $query = $request->except('_token', '_method', 'written', 'mcq', 'practical', 'mark_id', 'absent');

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);

        $marks = Mark::where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->get();

        return view('mark.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'marks'));
    }

    /**
     * ***********************************************************************************************
     * ***********************************************************************************************
     * ***********************************************************************************************
     */

    public function showQuery()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $groups = Group::all();
        $exam_terms = ExamTerm::all();
        $subjects = Subject::query()
            ->where('the_class_id', $classes->first()->id)
            ->where('group_id', $groups->first()->id)
            ->get();

        $is_show = true;

        return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects', 'is_show'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // TODO: Check if data exist or not!

        $query = $request->except(['_token']);

        /**
         * Check if data already exist
         */

        $check_result = Mark::query()->where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->count();

        if ($check_result == 0) {
            $classes = TheClass::all();
            $sections = Section::all();
            $shifts = Shift::all();
            $groups = Group::all();
            $exam_terms = ExamTerm::all();
            $subjects = Subject::query()
                ->where('the_class_id', $classes->first()->id)
                ->where('group_id', $groups->first()->id)
                ->get();

            $error_message = "Marks not added to this subject yet!";

            $is_show = true;

            return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects', 'query', 'is_show', 'error_message'));
        }

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);
        $subject = Subject::find($query['subject']);

        $marks = Mark::query()->where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->get();

        return view('mark.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'marks'));
    }


    /**
     * ***********************************************************************************************
     * ***********************************************************************************************
     * ***********************************************************************************************
     */

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateAdd(Request $request)
    {
        $query = $request->except(['_token']);

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);
        $subject = Subject::find($query['subject']);

        $marks = Mark::where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->get();

        $grades = Grade::orderBy('min_value', 'DESC')->get();

        // dd(compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'students'));

        $disable_form = true;

        return view('mark.edit', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'marks', 'disable_form', 'grades'));
    }

    public function update(Request $request)
    {
        $query = $request->except(['_token', '_method']);

//        dd($query);

        /*
array:12 [▼
  "theclass" => "1"
  "section" => "1"
  "shift" => "1"
  "group" => "1"
  "session" => "2018"
  "subject" => "763"
  "exam_term" => "1"
  "written" => array:26 [▶]
  "mcq" => array:26 [▶]
  "practical" => array:26 [▶]
  "mark_id" => array:28 [▶]
  "absent" => array:2 [▶]
]

         */

        $subject = Subject::find($query['subject']);

        $grades = Grade::orderBy('min_value', 'DESC')->get();

        // Getting dynamic Fail id
        $grade_fail_id = Grade::where('name', 'F')->pluck('id')->first();


        foreach ($query['mark_id'] as $student_id => $mark_id) {

            /**
             * Get the Mark element
             */
            $mark = Mark::find($mark_id);

//            $mark->student_id = $student_id;
//            $mark->the_class_id = $query['theclass'];
//            $mark->section_id = $query['section'];
//            $mark->shift_id = $query['shift'];
//            $mark->session = $query['session'];
//            $mark->exam_term_id = $query['exam_term'];

//            $mark->subject_id = $query['subject'];

            if (isset($query['absent'][$student_id])) {
                $mark->absent = true;

                $mark->written = 0;
                $mark->mcq = 0;
                $mark->practical = 0;

                $mark->total_marks = 0;

                $mark->grade_id = $grade_fail_id;
                $mark->point = 0;
            } else {
                $mark_written = 0;
                $mark_mcq = 0;
                $mark_practical = 0;

                if (isset($query['written'])) {
                    $mark_written = is_numeric($query['written'][$student_id]) ? $query['written'][$student_id] : 0;
                }

                if (isset($query['mcq'])) {
                    $mark_mcq = is_numeric($query['mcq'][$student_id]) ? $query['mcq'][$student_id] : 0;
                }

                if (isset($query['practical'])) {
                    $mark_practical = is_numeric($query['practical'][$student_id]) ? $query['practical'][$student_id] : 0;
                }

                $mark->written = $mark_written;
                $mark->mcq = $mark_mcq;
                $mark->practical = $mark_practical;

                $mark_total = floatval($mark_written) + floatval($mark_mcq) + floatval($mark_practical);

                $mark->total_marks = $mark_total;

                /**
                 * Check if student failed in portion of a subject
                 */
                $is_fail = false;

                if ($subject->has_written) {
                    if ($mark_written < $subject->written_pass_marks) {
                        $is_fail = true;
                    }
                }

                if ($subject->has_mcq) {
                    if ($mark_mcq < $subject->mcq_pass_marks) {
                        $is_fail = true;
                    }
                }

                if ($subject->has_practical) {
                    if ($mark_practical < $subject->practical_pass_marks) {
                        $is_fail = true;
                    }
                }

                $final_grade_point = 0;
                $final_grade_id = $grade_fail_id;

                if ($is_fail != true) {
                    foreach ($grades as $grade) {
                        if ($mark_total >= $grade->min_value) {
                            $final_grade_point = $grade->min_point;
                            $final_grade_id = $grade->id;
                            break;
                        }
                    }
                }

                $mark->grade_id = $final_grade_id;
                $mark->point = $final_grade_point;

            }

            $mark->save();

        }

        // for view
//        "written" => array:26 [▶]
//  "mcq" => array:26 [▶]
//  "practical" => array:26 [▶]
//  "mark_id" => array:28 [▶]
//  "absent" => array:2 [▶]

        $query = $request->except('_token', '_method', 'written', 'mcq', 'practical', 'mark_id', 'absent');

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);

        $marks = Mark::where('the_class_id', $query['theclass'])
            ->where('subject_id', $query['subject'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('session', $query['session'])
            ->where('exam_term_id', $query['exam_term'])
            ->get();

        return view('mark.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'marks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Mark $mark
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Mark $mark)
//    {
//        //
//    }
}
