<?php

namespace App\Http\Controllers;

use App\Model\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preferences = Preference::all();

        $assoc_preferences = Array();

        foreach ($preferences as $value) {
            $assoc_preferences[$value['key']] = $value['value'];
        }

        return view('preference.index', compact('assoc_preferences'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function show(Preference $preference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function edit(Preference $preference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $val = Array();

        foreach ($request->request as $key => $value) {
            
            if(substr( $key, 0, 1 ) === "_")
            {
                continue;
            }

            Preference::where('key', $key)
                ->update(['value' => $value]);
        }

        $assoc_preferences = $request->all();

        $success = true;

        return view('preference.index', compact('assoc_preferences', 'success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preference $preference)
    {
        //
    }
}
