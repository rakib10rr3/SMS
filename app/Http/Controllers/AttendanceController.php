<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
use App\SendSms;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $class_id = $request->get('the_class_id');
        $class_name = TheClass::where('id', '=', $class_id)->get();
        $shift_id = $request->get('shift_id');
        $shift_name = Shift::where('id', '=', $shift_id)->get();
        $section_id = $request->get('section_id');
        $section_name = Section::where('id', '=', $section_id)->get();
        $subject_id = $request->get('subject_id');
        $subject_name = Subject::where('id', '=', $subject_id)->get();
        $students = Student::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
        return view('attendance.create', compact('students', 'subject_name', 'section_name', 'shift_name', 'class_name'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sms_to_absent = $request->get('sms_to_absent');
        $class_id = $request->get('the_class_id');
        $shift_id = $request->get('shift_id');
        $section_id = $request->get('section_id');
        $subject_id = $request->get('subject_id');
        $date_string = request('date');
        $carbon = new Carbon($date_string);
        $date = $carbon->format('Y-m-d');

        /*
         * Storing absent student id's
         */
        $absent_students = array();
        foreach ($request->request as $key => $value) {
            if (is_numeric($key)) {

                if ($value == "0") {
                    array_push($absent_students, $key);
                }
                Attendance::create([
                    'date'=>$date,
                    'the_class_id'=>$class_id,
                    'shift_id'=>$shift_id,
                    'section_id'=>$section_id,
                    'subject_id'=>$subject_id,
                    'student_id'=>$key,
                ]);
            }
        }
        /*
         * Getting absent students local guardian cell and sent it to Sms Controller
         */
        $students_number = array();
        foreach ($absent_students as $index => $student_id) {
            $student = Student::find($student_id);
            array_push($students_number, $student->local_guardian_cell);
        }
        $sms_to = implode(",", $students_number);
        echo $sms_to;

//        if($sms_to_absent=="on")
//        {
//            (new \App\SendSms)->send_sms($sms_to,"Absent Tag");
//        }

        /**
         * Redirecting to attendance select with all value
         */

//        $sections = Section::all();
//        $classes = TheClass::all();
//        $shifts = Shift::all();
//        $subjects = Subject::all();
//        return redirect ('attendances/select');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $class_id = $request->get('the_class_id');
        $class_name = TheClass::where('id', '=', $class_id)->get();
        $shift_id = $request->get('shift_id');
        $shift_name = Shift::where('id', '=', $shift_id)->get();
        $section_id = $request->get('section_id');
        $section_name = Section::where('id', '=', $section_id)->get();
        $subject_id = $request->get('subject_id');
        $subject_name = Subject::where('id', '=', $subject_id)->get();
        $dob = request('date');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date = $carbon->format('Y-m-d');
        $students = Student::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
        $attended_students = Attendance::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->where('date', $date)->get();
        $attended_array = [];

        foreach ($attended_students as $attended_student) {
            $attended_array[] = $attended_student->student_id;
        }
        return view('attendance.show', compact('students', 'attended_students', 'subject_name', 'section_name', 'shift_name', 'class_name', 'attended_array', 'date'));
        //return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $sections = Section::all();
        $classes = TheClass::all();
        $shifts = Shift::all();
        $subjects = Subject::all();
        // return '1';
        return view('attendance.edit', compact('sections', 'classes', 'shifts', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $class_id = $request->get('the_class_id');
        $shift_id = $request->get('shift_id');
        $section_id = $request->get('section_id');
        $subject_id = $request->get('subject_id');
        $dob = request('date');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date = $carbon->format('Y-m-d');
        $alreadys = [];
        $form_ids = [];
        $attended_students = Attendance::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->where('date', $date)->get();
        foreach ($attended_students as $attended_student) {
            $alreadys[] = $attended_student->student_id;
        }
        foreach ($request->request as $key => $value) {
            if (is_numeric($key)) {
                $form_ids[] = $key;
                if (!in_array($key, $alreadys)) {
                    Attendance::create([
                        'date' => $date,
                        'the_class_id' => $class_id,
                        'shift_id' => $shift_id,
                        'section_id' => $section_id,
                        'subject_id' => $subject_id,
                        'student_id' => $key,
                    ]);
                }
            }
        }
        foreach ($alreadys as $already) {
            if (!in_array($already, $form_ids)) {
                Attendance::where('student_id', $already)->where('date', $date)->delete();
            }
        }
        return redirect('attendances/select');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function select()
    {
        $sections = Section::all();
        $classes = TheClass::all();
        $shifts = Shift::all();
        $subjects = Subject::all();
        // return '1';
        return view('attendance.select', compact('sections', 'classes', 'shifts', 'subjects'));
    }

    public function showForEdit(Request $request)
    {
        $class_id = $request->get('the_class_id');
        $class_name = TheClass::where('id', '=', $class_id)->get();
        $shift_id = $request->get('shift_id');
        $shift_name = Shift::where('id', '=', $shift_id)->get();
        $section_id = $request->get('section_id');
        $section_name = Section::where('id', '=', $section_id)->get();
        $subject_id = $request->get('subject_id');
        $subject_name = Subject::where('id', '=', $subject_id)->get();
        $dob = request('date');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date = $carbon->format('Y-m-d');
        $students = Student::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
        $attended_students = Attendance::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->where('date', $date)->get();
        $attended_array = [];

        foreach ($attended_students as $attended_student) {
            $attended_array[] = $attended_student->student_id;
        }
        return view('attendance.showForEdit', compact('students', 'attended_students', 'subject_name', 'section_name', 'shift_name', 'class_name', 'attended_array', 'date'));
        //return '1';
    }

    public function selectForView()
    {
        $sections = Section::all();
        $classes = TheClass::all();
        $shifts = Shift::all();
        $subjects = Subject::all();
        // return '1';
        return view('attendance.selectForView', compact('sections', 'classes', 'shifts', 'subjects'));
    }
}
