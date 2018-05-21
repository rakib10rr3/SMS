@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">
@endsection

@section('content')
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <h4 class="text-blue">Create Student</h4>
            <br>
        </div>
        <div class="wizard-content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="form" method="post" action="/students"  enctype="multipart/form-data">
                @csrf
                <h5>Identity</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">Date of Birth :</label>
                                <input type="text" class="form-control date-picker" placeholder="Select Date" id="dob"
                                       name="dob" value="{{old('dob')}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="father_name">Father's Name :</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="{{old('father_name')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="father_cell">Father's Phone Number :</label>
                                <input type="text" class="form-control" id="father_cell" name="father_cell"  value="{{old('father_cell')}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name :</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{old('mother_name')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mother_cell">Mother's Phone Number :</label>
                                <input type="text" class="form-control" id="mother_cell" name="mother_cell" value="{{old(('mother_cell'))}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="local_guardian_name">Local Guardian's Name :</label>
                                <input type="text" class="form-control" id="local_guardian_name"
                                       name="local_guardian_name" value="{{old('local_guardian_name')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="local_guardian_cell">Local Guardian's Phone Number :</label>
                                <input type="text" class="form-control" id="local_guardian_cell"
                                       name="local_guardian_cell" value="{{old('local_guardian_cell')}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{--<div class="form-group">--}}
                            {{--<label>Select Division :</label>--}}
                            {{--<select class="custom-select form-control" id="division_id" name="division_id">--}}
                            {{--<option value="">Select Division</option>--}}
                            {{--@foreach($divisions as $division)--}}
                            {{--<option value="{{$division->id}}">{{$division->name}}</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>Select District :</label>--}}
                            {{--<select class="custom-select form-control" name="district_id" id="district_id">--}}
                            {{--<option value="">Select District</option>--}}
                            {{--@foreach($districts as $district)--}}
                            {{--<option value="{{$district->id}}">{{$district->name}}</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="student_cell">Student's Phone Number (Optional) :</label>--}}
                                {{--<input type="text" class="form-control" id="cell"--}}
                                       {{--name="student_cell" value="{{old('student_cell')}}"/>--}}
                            {{--</div>--}}

                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h5>Personal</h5>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="religion_id">Religion :</label>
                                <select class="custom-select form-control" id="religion_id" name="religion_id" required>
                                    <option value="">Select Religion</option>
                                    @foreach($religions as $religion)
                                        <option value="{{$religion->id}}" {{(old('religion_id') == $religion->id?'selected':'')}}>{{$religion->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_group_id">Blood Group :</label>
                                <select class="custom-select form-control" id="blood_group_id" name="blood_group_id" required>
                                    <option value="">Select Blood Group</option>
                                    @foreach($bloodGroups as $bloodGroup)
                                        <option value="{{$bloodGroup->id}}" {{(old('blood_group_id') == $bloodGroup->id?'selected':'')}}>{{$bloodGroup->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender_id">Gender :</label>
                                <select class="custom-select form-control" id="gender_id" name="gender_id" required>
                                    <option value="">Select Gender</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}" {{(old('gender_id') == $gender->id?'selected':'')}}>{{$gender->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Nationality :</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{old('nationality')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Photo :</label>
                                <input type="file" class="form-control-file form-control height-auto" id="photo"
                                       name="photo" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_address">Present Address :</label>
                                <textarea class="form-control" id="current_address" name="current_address"  required>{{old('current_address')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address :</label>
                                <textarea class="form-control" id="permanent_address"
                                          name="permanent_address" required>{{old('permanent_address')}}</textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 3 -->
                <!-- Step 4 -->
                <h5>Academic</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            {{--<div class="form-group">--}}
                                {{--<label>Roll :</label>--}}
                                {{--<input type="number" class="form-control" id="roll" name="roll">--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label for="shift_id">Shift :</label>
                                <select class="custom-select form-control" id="shift_id" name="shift_id" required>
                                    <option value="">Select Shift</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{$shift->id}}" {{(old('shift_id') == $shift->id?'selected':'')}}>{{$shift->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="group_id">Group :</label>
                                <select class="custom-select form-control" id="group_id" name="group_id" required>
                                    <option value="">Select Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}" {{(old('group_id') == $group->id?'selected':'')}}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="the_class_id">Class</label>
                                <select class="custom-select form-control" id="the_class_id" name="the_class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{(old('the_class_id') == $class->id?'selected':'')}}>{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section_id">Section</label>
                                <select class="custom-select form-control" id="section_id" name="section_id" required>
                                    <option value="">Select Section</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}" {{(old('section_id') == $section->id?'selected':'')}}>{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="admission_year">Admission Year :</label>
                                <input type="text" class="form-control date-picker" placeholder="Select Date" id="admission_year"
                                       name="admission_year" value="{{old('admission_year')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="extra_activity">Extra Curricular Activities (Optional)</label>
                                <textarea class="form-control" id="extra_activity" name="extra_activity">{{old('extra_activity')}}</textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <input type="submit" value="Submit" class="btn btn-outline-success">
            </form>
        </div>
    </div>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('src/plugins/jquery-steps/build/jquery.steps.js')}}"></script>
    <script>
        $(".tab-wizard").steps({
            headerTag: "h5",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onFinished: function (event, currentIndex) {
                $("#form").submit();
            }
        });
    </script>


@endsection



