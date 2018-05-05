<?php

namespace App\Http\Controllers;

use App\Model\BloodGroup;
use Illuminate\Http\Request;

class BloodGroupController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BloodGroup $bloodGroup
     * @return \Illuminate\Http\Response
     */
    public function show(BloodGroup $bloodGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\BloodGroup $bloodGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodGroup $bloodGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\BloodGroup $bloodGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodGroup $bloodGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BloodGroup $bloodGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodGroup $bloodGroup)
    {
        //
    }

    public  function setup()
    {
        $bloodGroups = BloodGroup::query()->get();
        if (count($bloodGroups) == 0) {
            BloodGroup::insert([
                [
                    'name' => 'A+',
                ],
                [
                    'name' => 'A-',
                ],
                [
                    'name' => 'B+',
                ],
                [
                    'name' => 'B-',
                ],
                [
                    'name' => 'O+',
                ],
                [
                    'name' => 'O-',
                ],
                [
                    'name' => 'AB+',
                ],
                [
                    'name' => 'AB-',
                ],
            ]);
        } else {
            return "Data already exists";
        }
        return true;
    }
}
