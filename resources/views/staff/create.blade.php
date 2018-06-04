@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="/src/plugins/jquery-steps/build/jquery.steps.css">
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <h4 class="text-blue">Add Staff</h4>
            <p class="mb-30 font-14">Enter all field and click <span class="badge badge-secondary">Add</span></p>
        </div>
        <div class="wizard-content">

            <form id="form" method="post" enctype="multipart/form-data" action="{{route('staff.store')}}"
                  class="">
                @csrf

                <section>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name:</label>
                                <input value="{{old('name')}}" name="name" type="text" class="form-control"
                                       required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cell :</label>
                                <input value="{{old('cell')}}" name="cell" type="text" class="form-control"
                                       required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Current Address :</label>
                                <input value="{{old('current_address')}}" name="current_address" type="text"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Permanent Number :</label>
                                <input value="{{old('permanent_address')}}" name="permanent_address" type="text"
                                       class="form-control" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nationality :</label>
                                <input value="{{old('nationality')}}" name="nationality" type="text"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>National ID :</label>
                                <input value="{{old('national_id')}}" name="national_id" type="text"
                                       class="form-control" required/>
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
                                       placeholder="Select Date" required/>
                            </div>
                        </div>

                    </div>

                </section>

                <hr>

                <!-- Step 2 -->

                <section>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Gender:</label>
                                <select name="gender_id" class="custom-select form-control" required>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}" {{ (old("gender_id") == $gender->id ? "selected":"") }}>
                                            {{ $gender->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label>Religion:</label>
                                <select name="religion_id" class="custom-select form-control" required>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion->id }}" {{ (old("religion_id") == $religion->id ? "selected":"") }}>
                                            {{ $religion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label>Blood Group:</label>
                                <select name="blood_group_id" class="custom-select form-control" required>
                                    @foreach ($bloodGroups as $bloodGroup)
                                        <option value="{{ $bloodGroup->id }}" {{ (old("blood_group_id") == $bloodGroup->id ? "selected":"") }}>
                                            {{ $bloodGroup->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </section>

                <hr>

                <!-- Step 3 -->
                <section>
                    <div class="row">
                        <div class="col">
                            <label>Picture (Optional):</label>
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" value="{{old('photo')}}" name="photo"
                                       id="customInputPhoto">
                                <label class="custom-file-label" for="customInputPhoto">Choose image
                                    file</label>
                            </div>
                        </div>
                    </div>
                </section>

                <hr>

                <div class="row text-right">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-lg">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')

@endsection

