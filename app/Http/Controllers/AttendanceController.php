<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
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
        $class_name = TheClass::where('id','=',$class_id)->get();
        $shift_id = $request->get('shift_id');
        $shift_name = Shift::where('id','=', $shift_id)->get();
        $section_id = $request->get('section_id');
        $section_name = Section::where('id','=', $section_id)->get();
        $subject_id = $request->get('subject_id');
        $subject_name = Subject::where('id','=', $subject_id)->get();
        $students = Student::where('the_class_id', $class_id )->where('shift_id',$shift_id)->where('section_id',$section_id)->get();
        return view('attendance.create',compact('students','subject_name','section_name','shift_name','class_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_id = $request->get('the_class_id');
        $shift_id = $request->get('shift_id');
        $section_id = $request->get('section_id');
        $subject_id = $request->get('subject_id');
        $dob = request('date');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date=$carbon->format('Y-m-d');
        foreach ($request->request as $key=>$value)
        {
            if(is_numeric($key))
            {
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
        //echo $class_id;

        $sections = Section::all();
        $classes = TheClass::all();
        $shifts = Shift::all();
        $subjects = Subject::all();


        return view('attendance.select', compact('sections','classes', 'shifts', 'subjects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function select(){
        $sections = Section::all();
        $classes = TheClass::all();
        $shifts = Shift::all();
        $subjects = Subject::all();
       // return '1';
        return view('attendance.select', compact('sections','classes', 'shifts', 'subjects'));
    }
}
