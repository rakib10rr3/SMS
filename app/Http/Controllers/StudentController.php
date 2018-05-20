<?php

namespace App\Http\Controllers;

use \App\Model\Division;
use App\Model\District;
use App\Model\Group;
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
        return view('student.index', compact('classes','groups','sections','shifts'));
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
            'name' => 'required|',
            'dob' => 'required',
            'father_name' => 'required',
            'father_cell' => 'required',
            'mother_name' => 'required',
            'mother_cell' => 'required',
            'local_guardian_name' => 'required',
            'local_guardian_cell' => 'required',
            'religion_id' => 'required',
            'blood_group_id' => 'required',
            'gender_id' => 'required',
            'nationality' => 'required',
            'photo' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'roll' => 'required',
            'the_class_id' => 'required',
            //'user_id' => 'required',
            'shift_id' => 'required',
            'section_id' => 'required',
            'group_id' => 'required',
            'admission_year' => 'required',


        ];

        $customMessages = [
            'name.required' => 'Name field is required',
            'dob.required' => 'Date of Birth field is required',
            'father_name.required' => "Father's Name field is required",
            'mother_name.required' => "Mother's Name field is required",
            'local_guardian_name.required' => "Local Guardian's  Name field is required",
            'father_cell.required' => "Father's Phone Number field is required",
            'mother_cell.required' => "Father's Phone Number field is required",
            'local_guardian_cell.required' => "Local Guardian's Phone Number field is required",
            'religion_id.required' => "Religion field is required",
            'blood_group_id.required' => "Blood Group field is required",
            'gender_id.required' => "Gender field is required",
            'nationality.required' => "Nationality field is required",
            'photo.required' => "Photo field is required",
            'current_address.required' => "Present Address field is required",
            'permanent_address.required' => "Permanent Address field is required",
            'roll' => "Roll field is required",
            'the_class_id' => "Class field is required",
            'shift_id' => "Shift field is required",
            'section_id' => "Section field is required",
            'group_id' => "Group field is required",
            'admission_year' => "Admission Year field is required",

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

        $user_obj = new User;
        $user_name = request('name');
        $user_obj->name = $user_name;
        $user_obj->save();

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
        Student::query()->create([
            'name' => $request->name,
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
            'roll' => $request->roll,
            'user_id' => $user_obj->id,
            'shift_id' => $request->shift_id,
            'admission_year' => $admissionDate,
            'the_class_id' => $request->the_class_id,
            'section_id' => $request->section_id,
            'group_id' => $request->group_id,
            'cell' => $request->cell,

        ]);

        //return $request->dob;
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
        $request->validate([
            'name' => 'required|',
            'gender_id' => 'required',
            'nationality' => 'required',
            'dob' => 'required',
            'extra_activity' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'local_guardian_name' => 'required',
            'father_cell' => 'required',
            'mother_cell' => 'required',
            'local_guardian_cell' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'roll' => 'required',
            //'user_id' => 'required',
            'shift_id' => 'required',
            'admission_year' => 'required',
            'the_class_id' => 'required',
            'section_id' => 'required',
            'group_id' => 'required',
        ]);

        //Student::query()->where('id',)

        $dobString = request('dob');
        $carbon = new Carbon($dobString);
        $date = $carbon->format('Y-m-d');

        $admissionDateString = request('admission_year');
        $carbon = new Carbon($admissionDateString);
        $admissionDate = $carbon->format('Y-m-d');

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
        return redirect('/students');
    }

    public function getStudentList(Request $request){
        $students = Student::query()->where('the_class_id', '=', $request->the_class_id)
            ->where('group_id', '=', $request->group_id)
            ->where('section_id', '=', $request->section_id)
            ->where('shift_id', '=', $request->shift_id)
            ->orderBy('roll')
            ->get();
        return $students;
    }
}
