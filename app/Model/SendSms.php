<?php

namespace App;

use App\Model\Preference;
use App\Model\SmsHistory;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SendSms extends Model
{
    public function send_sms($to,$tag,$message)
    {


        $token = Config::get('constants.sms_bundle.token');
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
        $sms_history_obj = new SmsHistory;
        $sms_history_obj->from = Auth::user()->name;
        $sms_history_obj->to = $to;
        $sms_history_obj->message = $message;
        $sms_history_obj->tag = $tag;
        $sms_history_obj->save();
    }
}
