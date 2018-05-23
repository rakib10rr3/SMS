<?php

namespace App\Http\Controllers;

use App\Model\ClassAssign;
use App\Model\Group;
use App\Model\Preference;
use App\Model\Section;
use App\Model\Shift;
use App\Model\SmsHistory;
use App\Model\Student;
use App\Model\Subject;
use App\Model\TheClass;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
            if (!empty($class_id)) {
                $query = $query->where('the_class_id', $class_id);
            }

            if (!empty($subject_id)) {
                $query = $query->where('subject_id', $subject_id);
            }
            if (!empty($section_id)) {
                $query = $query->where('section_id', $section_id);
            }
            $teachers = $query->get();
            //$teachers = ClassAssign::where('the_class_id', $class_id)->where('subject_id', $subject_id)->where('section_id', $section_id)->get();
            return view('send_sms.create', compact('teachers', 'type', 'section_name', 'subject_name', 'class_name'));
        } else {
            /*
             * User used Custom Message Tab
             */
            $to = $request->get('to');
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

            /*
             * Saving for the log info
             */
            $sms_history_obj = new SmsHistory;
            $sms_history_obj->from = Auth::user()->name;
            $sms_history_obj->to = $to;
            $sms_history_obj->message = $message;
            $sms_history_obj->tag = Config::get('constants.tag.custom');;
            $sms_history_obj->save();


            return redirect('sendSms/select');
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
        //GuzzleHttp\Client
        $client = new Client();
        $result = $client->post($uri, [
            'form_params' => [
                'to' => $to,
                'message' => $message,
                'token' => $token
            ]
        ]);

        /*
         * Saving the log to the Sms History
         * tag name should be same as constant value
         */

        $tag = $request->get('tag');
        $sms_history_obj = new SmsHistory;
        $sms_history_obj->from = Auth::user()->name;
        $sms_history_obj->to = $to;
        $sms_history_obj->message = $message;
        $sms_history_obj->tag = Config::get('constants.tag.' . $tag);
        $sms_history_obj->save();

        return redirect('sendSms/select');
    }


    public function dropdown($class_id)
    {
        $models = TheClass::find($class_id)->subjects;
        return $models;

    }


    /**
     * @param $to => 0186666,018666,01585555,188855
     * @param $tag => From where you are sending the sms
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

//    public function send_sms($to, $tag)
//    {
//
//
//        $school_name = Preference::query()->pluck('institute_name');;
//        $message = "Absent Alert From " . $school_name;
//        $token = Config::get('constants.sms_bundle.token');
//        $uri = "http://sms.greenweb.com.bd/api.php";
//        //GuzzleHttp\Client
//        $client = new Client();
//        $result = $client->post($uri, [
//            'form_params' => [
//                'to' => $to,
//                'message' => $message,
//                'token' => $token
//            ]
//        ]);
//        /*
//         * Saving the log to the Sms History
//         * tag name should be same as constant value
//         */
//        $sms_history_obj = new SmsHistory;
//        $sms_history_obj->from = Auth::user()->name;
//        $sms_history_obj->to = $to;
//        $sms_history_obj->message = $message;
//        $sms_history_obj->tag = $tag;
//        $sms_history_obj->save();
//
//
//    }

    public function balance()
    {
        //  https://sms.greenweb.com.bd/g_api.php?token=4d4419ddc0bc3324187600e2d19911cd&tokensms
        $client = new Client();
        $token = Config::get('constants.sms_bundle.token');
        $base_url = "https://sms.greenweb.com.bd/g_api.php?token=" . $token;
        $balance_url = $base_url . "&balance";
        $total_sent_sms_url = $base_url . "&totalsms";


        $balance_request = $client->request('GET', $balance_url);
        $total_sent_sms_request = $client->request('GET', $total_sent_sms_url);

        $balance = strip_tags($balance_request->getBody());
        $total_sms = strip_tags($total_sent_sms_request->getBody());

        $result = "Your Total Balance is " . $balance . " taka and Total SMS Sent = " . $total_sms;
        return $result;
        //echo $balance ." ".$total_sms;
    }

}
