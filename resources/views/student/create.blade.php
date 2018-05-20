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
            <form id="form" method="post" action="/students" class="tab-wizard wizard-circle wizard vertical" enctype="multipart/form-data">
                @csrf
                <h5>Identity</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name :</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth :</label>
                                <input type="text" class="form-control date-picker" placeholder="Select Date" id="dob"
                                       name="dob">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Father's Name :</label>
                                <input type="text" class="form-control" id="father_name" name="father_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Father's Phone Number :</label>
                                <input type="text" class="form-control" id="father_cell" name="father_cell">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mother's Name :</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mother's Phone Number :</label>
                                <input type="text" class="form-control" id="mother_cell" name="mother_cell">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Local Guardian's Name :</label>
                                <input type="text" class="form-control" id="local_guardian_name"
                                       name="local_guardian_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Local Guardian's Phone Number :</label>
                                <input type="text" class="form-control" id="local_guardian_cell"
                                       name="local_guardian_cell">
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
                            <div class="form-group">
                                <label>Student's Phone Number (Optional) :</label>
                                <input type="text" class="form-control" id="cell"
                                       name="cell">
                            </div>

                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h5>Personal</h5>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Religion :</label>
                                <select class="custom-select form-control" id="religion_id" name="religion_id">
                                    <option value="">Select Religion</option>
                                    @foreach($religions as $religion)
                                        <option value="{{$religion->id}}">{{$religion->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Blood Group :</label>
                                <select class="custom-select form-control" id="blood_group_id" name="blood_group_id">
                                    <option value="">Select Blood Group</option>
                                    @foreach($bloodGroups as $bloodGroup)
                                        <option value="{{$bloodGroup->id}}">{{$bloodGroup->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender :</label>
                                <select class="custom-select form-control" id="gender_id" name="gender_id">
                                    <option value="">Select Gender</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nationality :</label>
                                <input type="text" class="form-control" id="nationality" name="nationality">
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
                                <label>Present Address :</label>
                                <textarea class="form-control" id="current_address" name="current_address"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Permanent Address :</label>
                                <textarea class="form-control" id="permanent_address"
                                          name="permanent_address"></textarea>
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
                                <label>Shift :</label>
                                <select class="custom-select form-control" id="shift_id" name="shift_id">
                                    <option value="">Select Shift</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{$shift->id}}">{{$shift->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Group :</label>
                                <select class="custom-select form-control" id="group_id" name="group_id">
                                    <option value="">Select Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Class</label>
                                <select class="custom-select form-control" id="the_class_id" name="the_class_id">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <select class="custom-select form-control" id="section_id" name="section_id">
                                    <option value="">Select Section</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Admission Year :</label>
                                <input type="text" class="form-control date-picker" placeholder="Select Date" id="admission_year"
                                       name="admission_year">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Extra Curricular Activities</label>
                                <textarea class="form-control" id="extra_activity" name="extra_activity"></textarea>
                            </div>


                        </div>
                    </div>
                </section>
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



