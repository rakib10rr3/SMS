<?php

namespace App\Http\Controllers;

use App\Model\ClassAssign;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->get('type');

        if ($type == "student") {
            $class_id = $request->get('the_class_id');
            $class_name = TheClass::where('id', '=', $class_id)->get();
            $shift_id = $request->get('shift_id');
            $shift_name = Shift::where('id', '=', $shift_id)->get();
            $section_id = $request->get('section_id');
            $section_name = Section::where('id', '=', $section_id)->get();
            $students = Student::where('the_class_id', $class_id)->where('shift_id', $shift_id)->where('section_id', $section_id)->get();
            return view('send_sms.create', compact('students', 'type', 'section_name', 'shift_name', 'class_name'));

        } else if ($type == "teacher") {
            $class_id = $request->get('the_class_id');
            $class_name = TheClass::where('id', '=', $class_id)->get();
            $subject_id = $request->get('subject_id');
            $subject_name = Subject::where('id', '=', $subject_id)->get();
            $section_id = $request->get('section_id');
            $section_name = Section::where('id', '=', $section_id)->get();

            $query = ClassAssign::query();
            if (! empty($class_id)) {
                $query = $query->where('the_class_id', $class_id);
            }

            if (! empty($subject_id)) {
                $query = $query->where('subject_id', $subject_id);
            }
            if (! empty($section_id)) {
                $query = $query->where('section_id', $section_id);
            }
            $teachers = $query->get();
            //$teachers = ClassAssign::where('the_class_id', $class_id)->where('subject_id', $subject_id)->where('section_id', $section_id)->get();
            return view('send_sms.create', compact('teachers', 'type', 'section_name', 'subject_name', 'class_name'));
        }

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


    public function dropdown($class_id)
    {
        $models = TheClass::find($class_id)->subjects;
        return $models;

    }
}
