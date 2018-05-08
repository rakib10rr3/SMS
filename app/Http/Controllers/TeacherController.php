<?php

namespace App\Http\Controllers;

use App\Model\BloodGroup;
use App\Model\Gender;
use App\Model\Religion;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $religions = Religion::all();
        $genders = Gender::all();
        $bloodGroups = BloodGroup::all();
        return view('teachers.create', compact('religions', 'genders', 'bloodGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'current_address' => 'required|max:50',
            'permanent_address' =>  'required|max:50',
            'dob' => 'required',
            'national_id' => 'required|max:20',
            'nationality' =>  'required',
            'cell' => 'required|max:11',
            'photo' =>  'required',


        ]);




        //Teacher::query()->create($request->all());
        $user_obj = new User;
        $user_name = request('name');
        $user_obj->name = $user_name;
        $user_obj->save();





        $current_address = request('current_address');
        $permanent_address = request('permanent_address');

        $dob = request('dob');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date=$carbon->format('Y-m-d');



        $national_id = request('national_id');
        $marital_status = request('marital_status');
        $religion_id = request('religion_id');
        $blood_group_id = request('blood_group_id');
        $gender_id = request('gender_id');
        $nationality = request('nationality');
        $cell = request('cell');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $picture_name = $file->getClientOriginalName();
            $file->move('images/teachers/' . $user_name, $picture_name);
        } else {
            $picture_name = "No Image Found ";
        }

        $api_value = Teacher::create([
            'user_id' => $user_obj->id,
            'name' => $user_name,
            'current_address' => $current_address,
            'permanent_address' => $permanent_address,
            'dob' => $date,
            'national_id' => $national_id,
            'marital_status' => $marital_status,
            'religion_id' => $religion_id,
            'blood_group_id' => $blood_group_id,
            'gender_id' => $gender_id,
            'nationality' => $nationality,
            'cell' => $cell,
            'photo' => $picture_name,
        ]);


        return redirect('/teachers');

        // return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $religions = Religion::all();
        $genders = Gender::all();
        $bloodGroups = BloodGroup::all();
        return view('teachers.edit', compact('teacher', 'religions', 'genders', 'bloodGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //Teacher::query()->create($request->all());

        $user_name = request('name');


        $current_address = request('current_address');
        $permanent_address = request('permanent_address');

        $dob = request('dob');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date=$carbon->format('Y-m-d');


        $national_id = request('national_id');
        $marital_status = request('marital_status');
        $religion_id = request('religion_id');
        $blood_group_id = request('blood_group_id');
        $gender_id = request('gender_id');
        $nationality = request('nationality');
        $cell = request('cell');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $picture_name = $file->getClientOriginalName();
            $file->move('images/teachers' . $user_name, $picture_name);
        } else {
            $picture_name = "No Image Found ";
        }


        Teacher::where('id', $teacher->id)->update(array(
            'user_id' => $teacher->user->id,
            'name' => $user_name,
            'current_address' => $current_address,
            'permanent_address' => $permanent_address,
            'dob' => $date,
            'national_id' => $national_id,
            'marital_status' => $marital_status,
            'religion_id' => $religion_id,
            'blood_group_id' => $blood_group_id,
            'gender_id' => $gender_id,
            'nationality' => $nationality,
            'cell' => $cell,
            'photo' => $picture_name,
        ));
        return redirect('/teachers');

//        return "came to update the data";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect('/teachers');
    }
}
