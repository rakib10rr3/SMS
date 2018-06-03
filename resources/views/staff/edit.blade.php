@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="/src/plugins/jquery-steps/build/jquery.steps.css">
@endsection

@section('content')

    <div class="min-height-200px">


        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <h4 class="text-blue">Step wizard vertical</h4>
                <p class="mb-30 font-14">jQuery Step wizard</p>
            </div>
            <div class="wizard-content">
                <form id="form" method="post" enctype="multipart/form-data"
                      action="{{route('staff.update', ['staff' => $staff->id])}}"
                      class="">
                    @csrf
                    {{method_field('PUT')}}
                    <h5> Identity </h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name :</label>
                                    <input name="name" type="text" class="form-control" value="{{$staff->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cell :</label>
                                    <input name="cell" type="text" class="form-control" value="{{$staff->cell}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Current Address :</label>
                                    <input name="current_address" type="text" class="form-control"
                                           value="{{$staff->current_address}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Permanent Address :</label>
                                    <input name="permanent_address" type="text" class="form-control"
                                           value="{{$staff->permanent_address}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality :</label>
                                    <input name="nationality" type="text" class="form-control"
                                           value="{{$staff->nationality}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>National ID :</label>
                                    <input name="national_id" type="text" class="form-control"
                                           value="{{$staff->national_id}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Marital Status:</label>
                                    <select name="marital_status" class="custom-select form-control">
                                        <option value="0" {{"0" == $staff->marital_status ? 'selected':''}}>Unmarried</option>
                                        <option value="1" {{"1" == $staff->marital_status ? 'selected':''}}>Married</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth :</label>
                                    <input type="text" name="dob" class="form-control date-picker"
                                           value="{{Carbon\Carbon::parse($staff->dob)->format('d F Y')}}"
                                           placeholder="Select Date">
                                </div>
                            </div>

                        </div>

                    </section>
                    <!-- Step 2 -->
                    <h5> Personal Info </h5>
                    <section>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Religion:</label>
                                    <select name="religion_id" class="custom-select form-control"
                                            value="{{$staff->religion_id}}">
                                        @foreach ($religions as $religion)
                                            {{--<option value="{{ $religion->id }}">--}}
                                            {{--{{ $religion->name }}--}}
                                            {{--</option>--}}

                                            <option value="{{$religion->id}}" {{ $religion->id === $staff->religion_id? 'selected' : '' }}>{{$religion->name}}

                                            </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Blood Group:</label>
                                    <select name="blood_group_id" class="custom-select form-control"
                                            value="{{$staff->blood_group_id}}">
                                        @foreach ($bloodGroups as $bloodGroup)

                                            <option value="{{$bloodGroup->id}}" {{ $bloodGroup->id === $staff->blood_group_id? 'selected' : '' }}>{{$bloodGroup->name}}

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <select name="gender_id" class="custom-select form-control"
                                            value="{{$staff->gender_id}}">
                                        @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" {{ $gender->id === $staff->gender_id? 'selected' : '' }}>{{$gender->name}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Photo</h5>
                    <section>
                        <div class="row">
                            <div class="col">
                                <input type="file" name="photo" id="photo">
                            </div>
                        </div>
                    </section>
                    <div class="col-md-12">
                        <label>Photo</label>
                        <img height="64px" width="64px" src="/images/staffs/{{$staff->photo}}"
                             alt="pic">
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="previous_pic" value="{{$staff->photo}}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- success Popup html Start -->
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h3 class="mb-20">Form Submitted!</h3>
                        <div class="mb-30 text-center"><img src="{{asset('vendors/images/success.png')}}"></div>
                        Successfully Saved Data
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- success Popup html End -->
    </div>


@endsection



<!-- Form wizard Js  -->
@section('scripts')

    <script src="/src/plugins/jquery-steps/build/jquery.steps.js"></script>
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
                // $('#success-modal').modal('show');
                $("#form").submit();
            }
        });
    </script>

@endsection
