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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
        $subjects = Subject::where('the_class_id', 1)->get();

        return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Return the list to add data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $query = $request->except(['_token', 'DataTables_Table_0_length']);

        // dd($query);

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
        $the_class = $query['theclass'];

        $class = TheClass::find($query['theclass']);
        $section = Section::find($query['section']);
        $shift = Shift::find($query['shift']);
        $group = Group::find($query['group']);
        $exam_term = ExamTerm::find($query['exam_term']);
        $subject = Subject::find($query['subject']);

        $students = Student::where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('group_id', $query['group'])
            ->get();

        // dd(compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'students'));

        return view('mark.add', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'students'));
    }

    /**
     * Store the added data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = $request->except(['_token', '_method']);

        // dd($query);

        // todo: check if already data exist

        // $check_result = Mark::where('the_class_id', $query['theclass'])
        //     ->where('subject_id', $query['subject'])
        //     ->where('section_id', $query['section'])
        //     ->where('shift_id', $query['shift'])
        //     ->where('session', $query['session'])
        //     ->where('exam_term_id', $query['exam_term'])
        //     ->count();

        // if($check_result <= 0)

        $grades = Grade::orderBy('min_value', 'DESC')->get();

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

        $students = Student::where('the_class_id', $query['theclass'])
            ->where('section_id', $query['section'])
            ->where('shift_id', $query['shift'])
            ->where('group_id', $query['group'])
            ->get();

        foreach ($students as $student) {
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

                $mark_total = intval($mark_written) + intval($mark_mcq) + intval($mark_practical);

                // todo: mark greater then 100!
                $mark->total_marks = $mark_total;

                $final_grade_point = 0;
                $final_grade = '';

                // grade point
                foreach ($grades as $grade) {
                    if ($mark_total >= $grade->min_value) {
                        $final_grade_point = $grade->min_point;
                        $final_grade_id = $grade->id;
                        break;
                    }
                }

                $mark->grade_id = $final_grade_id;
                $mark->point = $final_grade_point;

            }

            $mark->save();

        }

        // for view

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

        return view('mark.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'marks'));
    }

    public function showQuery()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $shifts = Shift::all();
        $groups = Group::all();
        $exam_terms = ExamTerm::all();
        $subjects = Subject::where('the_class_id', 1)->get();

        $is_show = true;

        return view('mark.query', compact('classes', 'sections', 'shifts', 'groups', 'exam_terms', 'subjects', 'is_show'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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

        return view('mark.view', compact('class', 'section', 'shift', 'group', 'exam_term', 'subject', 'query', 'marks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
