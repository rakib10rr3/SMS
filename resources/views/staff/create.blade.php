@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="/src/plugins/jquery-steps/build/jquery.steps.css">
@endsection

@section('content')

    <div class="min-height-200px">


        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <h4 class="text-blue">Add staff</h4>
                <p class="mb-30 font-14">Enter all field and click Submit</p>
            </div>
            <div class="wizard-content">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="form" method="post" enctype="multipart/form-data" action="{{route('staff.store')}}"
                      class="">
                    @csrf
                    <h5> Identity </h5>
                    <section>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input value="{{old('name')}}" name="name" type="text" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cell :</label>
                                    <input value="{{old('cell')}}" name="cell" type="text" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Current Address :</label>
                                    <input value="{{old('current_address')}}" name="current_address" type="text"
                                           class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Permanent Number :</label>
                                    <input value="{{old('permanent_address')}}" name="permanent_address" type="text"
                                           class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality :</label>
                                    <input value="{{old('nationality')}}" name="nationality" type="text"
                                           class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>National ID :</label>
                                    <input value="{{old('national_id')}}" name="national_id" type="text"
                                           class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Marital Status:</label>
                                    <select name="marital_status" class="custom-select form-control" required>
                                        <option value="0"{{ (old("marital_status") == "0" ? "selected":"") }}>
                                            Unmarried
                                        </option>
                                        <option value="1"{{ (old("marital_status") == "1" ? "selected":"") }}>Married
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth :</label>
                                    <input value="{{old('dob')}}" type="text" name="dob"
                                           class="form-control date-picker"
                                           placeholder="Select Date" required />
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
                                    <select name="religion_id" class="custom-select form-control" required >
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id }}" {{ (old("religion_id") == $religion->id ? "selected":"") }}>
                                                {{ $religion->name }}
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
                                    <select name="blood_group_id" class="custom-select form-control" required >
                                        @foreach ($bloodGroups as $bloodGroup)
                                            <option value="{{ $bloodGroup->id }}" {{ (old("blood_group_id") == $bloodGroup->id ? "selected":"") }}>
                                                {{ $bloodGroup->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <select name="gender_id" class="custom-select form-control" required >
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ (old("gender_id") == $gender->id ? "selected":"") }}>
                                                {{ $gender->name }}
                                            </option>
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
                                <input value="{{old('photo')}}" type="file" name="photo" id="photo">
                            </div>
                        </div>
                    </section>
                    <div class="row">
                        <div class="col">
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

