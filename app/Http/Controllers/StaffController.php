<?php

namespace App\Http\Controllers;

use App\Model\BloodGroup;
use App\Model\Gender;
use App\Model\Preference;
use App\Model\Religion;
use App\Model\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::all();

        return view('staff.index', compact('staffs'));
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
        return view('staff.create', compact('religions', 'genders', 'bloodGroups'));
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
            'permanent_address' => 'required|max:50',
            'dob' => 'required',
            'national_id' => 'required|max:20',
            'nationality' => 'required',
            'cell' => 'required|max:11',
        ]);

        $name = request('name');

        /**
         * Create a User Object
         */
        // Get the last reg id
        $reg_id = intval(Preference::query()->where('key', 'staff_id_counter')->value('value'));

        // Update the preference
        $new_reg_id = intval($reg_id) + 1;
        Preference::query()->where('key', 'staff_id_counter')
            ->update(['value' => $new_reg_id]);

        // Let's create the new user
        $user_obj = new User;
        // Here, C for Clerk
        $user_name = 'C' . date('y') . str_pad($reg_id, 4, "0", STR_PAD_LEFT);

        $user_obj->username = $user_name;
        $user_obj->password = bcrypt('password');
        $user_obj->role_id = 3;
        $user_obj->save();

        /**
         * End Object Creation
         */

        $current_address = request('current_address');
        $permanent_address = request('permanent_address');

        $dob = request('dob');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date = $carbon->format('Y-m-d');


        $national_id = request('national_id');
        $marital_status = request('marital_status');
        $religion_id = request('religion_id');
        $blood_group_id = request('blood_group_id');
        $gender_id = request('gender_id');
        $nationality = request('nationality');
        $cell = request('cell');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $picture_name = $user_obj->id . "." . $file->guessClientExtension();
            $file->move('images/staffs', $picture_name);
        } else {
            $picture_name = null;
        }

        $staff = Staff::query()->create([
            'user_id' => $user_obj->id,
            'name' => $name,
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

//        $staff->user->role_id = 3;
//        $staff->user->save();


        return redirect()->route('staff.index');

        // return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param staff $staff
     * @return void
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param staff $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $religions = Religion::all();
        $genders = Gender::all();
        $bloodGroups = BloodGroup::all();
        return view('staff.edit', compact('staff', 'religions', 'genders', 'bloodGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param staff $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //Teacher::query()->create($request->all());

        $user_name = request('name');


        $current_address = request('current_address');
        $permanent_address = request('permanent_address');

        $dob = request('dob');
        $date_string = $dob;
//        $date = date_create_from_format('Y-m-d', $date_string);
        $carbon = new Carbon($date_string);
        $date = $carbon->format('Y-m-d');


        $national_id = request('national_id');
        $marital_status = request('marital_status');
        $religion_id = request('religion_id');
        $blood_group_id = request('blood_group_id');
        $gender_id = request('gender_id');
        $nationality = request('nationality');
        $cell = request('cell');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $picture_name = $staff->user->id . "." . $file->guessClientExtension();
            $file->move('images/staffs', $picture_name);
        } else {
            $picture_name = "No Image Found ";
        }


        Staff::query()
            ->where('id', $staff->id)
            ->update(array(
                'user_id' => $staff->user->id,
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

        return redirect()->route('staff.index');

//        return "came to update the data";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param staff $staff
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index');
    }
}
