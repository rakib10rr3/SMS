<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;

class SendSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class_id = $request->get('the_class_id');
        $class_name = TheClass::where('id', '=', $class_id)->get();
        $shift_id = $request->get('shift_id');
        $shift_name = Shift::where('id', '=', $shift_id)->get();
        $section_id = $request->get('section_id');
        $section_name = Section::where('id', '=', $section_id)->get();
        $subject_id = $request->get('subject_id');
        $subject_name = Subject::where('id', '=', $subject_id)->get();
        $students = Student::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
        return view('send_sms.index', compact('students', 'subject_name', 'section_name', 'shift_name', 'class_name'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $class_id = $request->get('the_class_id');
        $class_name = TheClass::where('id', '=', $class_id)->get();
        $shift_id = $request->get('shift_id');
        $shift_name = Shift::where('id', '=', $shift_id)->get();
        $section_id = $request->get('section_id');
        $section_name = Section::where('id', '=', $section_id)->get();

        $students = Student::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
        return view('send_sms.create', compact('students', 'section_name', 'shift_name', 'class_name'));

    }

    public function select()
    {
        $classes = TheClass::all();
        $sections = Section::all();
        $groups = Group::all();
        $subjects = Subject::all();
        $shifts = Shift::all();
        return view('send_sms.select', compact('classes', 'subjects', 'sections', 'groups', 'shifts'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->merge([
            'checkbox' => implode(',', (array)$request->get('checkbox'))
        ]);
        $to = $request->get('checkbox');
        $message = $request->get('message');
        $token = $request->get('token');


        $uri = "http://sms.greenweb.com.bd/api.php";
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->post($uri, [
            'form_params' => [
                'to' => $to,
                'message' => $message,
                'token' => $token
            ]
        ]);


        return redirect('sendSms/select');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dropdown()
    {

        $id = Input::get('option');
        $models = TheClass::find($id)->subjects;
        return $models;

    }
}
