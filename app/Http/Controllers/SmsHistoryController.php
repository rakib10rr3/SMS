<?php

namespace App\Http\Controllers;

use App\Model\SmsHistory;
use Illuminate\Http\Request;

class SmsHistoryController extends Controller
{
    /**
     * Display a listing of the resource
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $all_sms = SmsHistory::orderBy('created_at','desc')->get();
        return view('sms_history.index', compact('all_sms'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     * @param  \App\SmsHistory $smsHistory
     * @return \Illuminate\Http\Response
     */
    public function show(SmsHistory $smsHistory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\SmsHistory $smsHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsHistory $smsHistory)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\SmsHistory $smsHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsHistory $smsHistory)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SmsHistory $smsHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsHistory $smsHistory)
    {

    }
}
