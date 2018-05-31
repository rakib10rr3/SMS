<?php

namespace App\Http\Controllers;

use \App\Model\Division;
use App\Model\District;
use App\Model\Group;
use App\Model\Preference;
use App\Model\Section;
use App\Model\Shift;
use App\Model\Student;
use App\Model\Religion;
use App\Model\Gender;
use App\Model\BloodGroup;

use App\Model\TheClass;
use App\User;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = TheClass::query()->get();
        $groups = Group::query()->get();
        $sections = Section::query()->get();
        $shifts = Shift::query()->get();
        //$students = Student::query()->limit(10)->get();
        return view('student.index', compact('classes', 'groups', 'sections', 'shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::query()->get();
        $districts = District::query()->get()->sortBy('name');
        $religions = Religion::query()->get();
        $genders = Gender::query()->get();
        $bloodGroups = BloodGroup::query()->get();
        $shifts = Shift::query()->get();
        $sections = Section::query()->get();
        $groups = Group::query()->get();
        $classes = TheClass::query()->get();
        return view('student.create', compact('divisions', 'districts', 'religions', 'bloodGroups', 'genders', 'shifts', 'sections', 'groups', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|regex:/[a-zA-Z\s]+/',
            'dob' => 'required',
            'father_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'father_cell' => 'required|digits:11',
            'mother_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'mother_cell' => 'required|digits:11',
            'local_guardian_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'local_guardian_cell' => 'required|digits:11',
            'religion_id' => 'required',
            'blood_group_id' => 'required',
            'gender_id' => 'required',
            'nationality' => 'required',
            'photo' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            //'roll' => 'required',
            'the_class_id' => 'required',
            //'user_id' => 'required',
            'shift_id' => 'required',
            'section_id' => 'required',
            'group_id' => 'required',
            'admission_year' => 'required',
            'session_year' => 'required|integer|between:2000,2099|digits:4'


        ];

        $customMessages = [
            'name.required' => 'Name field is required',
            'name.regex' => 'Name field must contain only letters',
            'dob.required' => 'Date of Birth field is required',
            'father_name.required' => "Father's Name field is required",
            'father_name.alpha' => "Father's Name must contain only letters",
            'mother_name.required' => "Mother's Name field is required",
            'mother_name.alpha' => "Mother's Name field must contain only letters",
            'local_guardian_name.required' => "Local Guardian's Name field is required",
            'local_guardian_name.alpha' => "Local Guardian's Name field field must contain only letters",
            'father_cell.required' => "Father's Phone Number field is required",
            'father_cell.digits' => "Father's Phone Number must contain 11 digits",
            'mother_cell.digits' => "Mother's Phone Number must contain 11 digits",
            'local_guardian_cell.digits' => "Local Guardian's Phone Number must contain 11 digits",
            // 'student_cell.digits' => "Student's Phone Number must contain 11 digits",
            'mother_cell.required' => "Father's Phone Number field is required",
            'local_guardian_cell.required' => "Local Guardian's Phone Number field is required",
            'religion_id.required' => "Religion field is required",
            'blood_group_id.required' => "Blood Group field is required",
            'gender_id.required' => "Gender field is required",
            'nationality.required' => "Nationality field is required",
            'photo.required' => "Photo field is required",
            'current_address.required' => "Present Address field is required",
            'permanent_address.required' => "Permanent Address field is required",
            // 'roll.required' => "Roll field is required",
            'the_class_id.required' => "Class field is required",
            'shift_id.required' => "Shift field is required",
            'section_id.required' => "Section field is required",
            'group_id.required' => "Group field is required",
            'admission_year.required' => "Admission Year field is required",
            'session_year.between' => 'Session must be between year 2000 and 2099',
            'session_year.digits' => 'Session year must be of 4 digits'

        ];

        $this->validate($request, $rules, $customMessages);

//        $request->validate([
//            'name' => 'required|',
//            'gender_id' => 'required',
//            'nationality' => 'required',
//            'dob' => 'required',
//            'extra_activity' => 'required',
//            'photo' => 'required',
//            'father_name' => 'required',
//            'mother_name' => 'required',
//            'local_guardian_name' => 'required',
//            'father_cell' => 'required',
//            'mother_cell' => 'required',
//            'local_guardian_cell' => 'required',
//            'current_address' => 'required',
//            'permanent_address' => 'required',
//            'roll' => 'required',
//            //'user_id' => 'required',
//            'shift_id' => 'required',
//            'admission_year' => 'required',
//            'the_class_id' => 'required',
//            'section_id' => 'required',
//            'group_id' => 'required',
//        ]);
        //Student::query()->create($request->all());

        $name = request('name');

        /**
         * Create a User Object
         */
        // Get the last reg id
        $reg_id = intval(Preference::query()->where('key', 'student_id_counter')->value('value'));

        // Update the preference
        $new_reg_id = intval($reg_id) + 1;
        Preference::query()->where('key', 'student_id_counter')
            ->update(['value' => $new_reg_id]);

        // Let's create the new user
        $user_obj = new User;
        // Here, S for Student
        $user_name = 'S' . date('y') . str_pad($reg_id, 4, "0", STR_PAD_LEFT);

        $user_obj->username = $user_name;
        $user_obj->password = bcrypt('password');
        $user_obj->role_id = 1;
        $user_obj->save();

        /**
         * End Object Creation
         */

        $dobString = request('dob');
        $carbon = new Carbon($dobString);
        $date = $carbon->format('Y-m-d');

        $admissionDateString = request('admission_year');
        $carbon = new Carbon($admissionDateString);
        $admissionDate = $carbon->format('Y');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $picture_name = $file->getClientOriginalName();
            $file->move('images/' . $user_obj->id, $picture_name);
        } else {
            $picture_name = "No Image Found ";
        }

        $lastRoll = Student::query()
            ->where('group_id', $request->group_id)
            ->where('shift_id', $request->shift_id)
            ->where('the_class_id', $request->the_class_id)
            ->where('section_id', $request->section_id)
            ->max('roll');

        if (empty($lastRoll)) {
            $newRoll = 1;
        } else
            $newRoll = ++$lastRoll;

        Student::query()->create([
            'name' => $name,
            'religion_id' => $request->religion_id,
            'blood_group_id' => $request->blood_group_id,
            'gender_id' => $request->gender_id,
            'nationality' => $request->nationality,
            'dob' => $date,
            'extra_activity' => $request->extra_activity,
            'photo' => $picture_name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'local_guardian_name' => $request->local_guardian_name,
            'father_cell' => $request->father_cell,
            'mother_cell' => $request->mother_cell,
            'local_guardian_cell' => $request->local_guardian_cell,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'roll' => $newRoll,
            'user_id' => $user_obj->id,
            'shift_id' => $request->shift_id,
            'admission_year' => $admissionDate,
            'the_class_id' => $request->the_class_id,
            'section_id' => $request->section_id,
            'group_id' => $request->group_id,
            'cell' => $request->cell,
            'session' => $request->session_year
        ]);

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {

        $divisions = Division::query()->get();
        $districts = District::query()->get()->sortBy('name');
        $religions = Religion::query()->get();
        $genders = Gender::query()->get();
        $bloodGroups = BloodGroup::query()->get();
        $shifts = Shift::query()->get();
        $sections = Section::query()->get();
        $groups = Group::query()->get();
        $classes = TheClass::query()->get();
        return view('student.edit', compact('student', 'districts', 'religions', 'divisions', 'genders', 'bloodGroups', 'shifts', 'sections', 'groups', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $rules = [
            'name' => 'required|regex:/[a-zA-Z\s]+/',
            'dob' => 'required',
            'father_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'father_cell' => 'required|digits:11',
            'mother_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'mother_cell' => 'required|digits:11',
            'local_guardian_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'local_guardian_cell' => 'required|digits:11',
            'religion_id' => 'required',
            'blood_group_id' => 'required',
            'gender_id' => 'required',
            'nationality' => 'required',
            'photo' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            //'roll' => 'required',
            'the_class_id' => 'required',
            //'user_id' => 'required',
            'shift_id' => 'required',
            'section_id' => 'required',
            'group_id' => 'required',
            'admission_year' => 'required',
            'session_year' => 'required|integer|between:2000,2099|digits:4'

        ];

        $customMessages = [
            'name.required' => 'Name field is required',
            'name.regex' => 'Name field must contain only letters',
            'dob.required' => 'Date of Birth field is required',
            'father_name.required' => "Father's Name field is required",
            'father_name.alpha' => "Father's Name must contain only letters",
            'mother_name.required' => "Mother's Name field is required",
            'mother_name.alpha' => "Mother's Name field must contain only letters",
            'local_guardian_name.required' => "Local Guardian's Name field is required",
            'local_guardian_name.alpha' => "Local Guardian's Name field field must contain only letters",
            'father_cell.required' => "Father's Phone Number field is required",
            'father_cell.digits' => "Father's Phone Number must contain 11 digits",
            'mother_cell.digits' => "Mother's Phone Number must contain 11 digits",
            'local_guardian_cell.digits' => "Local Guardian's Phone Number must contain 11 digits",
            // 'student_cell.digits' => "Student's Phone Number must contain 11 digits",
            'mother_cell.required' => "Father's Phone Number field is required",
            'local_guardian_cell.required' => "Local Guardian's Phone Number field is required",
            'religion_id.required' => "Religion field is required",
            'blood_group_id.required' => "Blood Group field is required",
            'gender_id.required' => "Gender field is required",
            'nationality.required' => "Nationality field is required",
            'photo.required' => "Photo field is required",
            'current_address.required' => "Present Address field is required",
            'permanent_address.required' => "Permanent Address field is required",
            // 'roll.required' => "Roll field is required",
            'the_class_id.required' => "Class field is required",
            'shift_id.required' => "Shift field is required",
            'section_id.required' => "Section field is required",
            'group_id.required' => "Group field is required",
            'admission_year.required' => "Admission Year field is required",
            'session_year.between' => 'Session must be between year 2000 and 2099',
            'session_year.digits' => 'Session year must be of 4 digits'

        ];

        $this->validate($request, $rules, $customMessages);
        //Student::query()->where('id',)

        $dobString = request('dob');
        $carbon = new Carbon($dobString);
        $date = $carbon->format('Y-m-d');

        $admissionDateString = request('admission_year');
        $carbon = new Carbon($admissionDateString);
        $admissionDate = $carbon->format('Y');

//        if ($request->hasFile('photo')) {
//            $file = $request->file('photo');
//            $picture_name = $file->getClientOriginalName();
//            $file->move('images/' . $user_obj->id, $picture_name);
//        } else {
//            $picture_name = "No Image Found ";
//        }
        Student::query()->where('id', '=', $request->id)->update([
            'name' => $request->name,
            'religion_id' => $request->religion_id,
            'blood_group_id' => $request->blood_group_id,
            'gender_id' => $request->gender_id,
            'nationality' => $request->nationality,
            'dob' => $date,
            'extra_activity' => $request->extra_activity,
//            'photo' => $picture_name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'local_guardian_name' => $request->local_guardian_name,
            'father_cell' => $request->father_cell,
            'mother_cell' => $request->mother_cell,
            'local_guardian_cell' => $request->local_guardian_cell,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'roll' => $request->roll,
//            'user_id' => $user_obj->id,
            'shift_id' => $request->shift_id,
            'admission_year' => $admissionDate,
            'the_class_id' => $request->the_class_id,
            'section_id' => $request->section_id,
            'group_id' => $request->group_id,
            'cell' => $request->cell,
            'session' => $request->session_year,
            'is_active' => $request->status,


        ]);
        // return $request->all();
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        User::query()->where('id',$student->user_id)->delete();

        return redirect('/students');
    }

    public function getStudentList(Request $request)
    {

        $students = Student::query()
            ->where('the_class_id', '=', $request->the_class_id)
            ->where('group_id', '=', $request->group_id)
            ->where('section_id', '=', $request->section_id)
            ->where('shift_id', '=', $request->shift_id)
            ->where('session', '=', $request->session_year)
            ->orderBy('roll')
            ->get();
        return $students;
    }

    public function changeStatus($id){

    }
}
