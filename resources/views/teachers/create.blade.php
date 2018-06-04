@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">
@endsection

@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <h4 class="text-blue">Add Teacher</h4>
            <p class="mb-30 font-14">Enter all field and click <span class="badge badge-secondary">Add</span></p>
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

            <form id="form" method="post" enctype="multipart/form-data" action="{{route('teachers.store')}}">
                @csrf

                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input name="name" type="text" id="name" class="form-control"
                                       value="{{old('name')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cell">Cell :</label>
                                <input name="cell" id="cell" type="text" class="form-control"
                                       value="{{old('cell')}}" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_address">Current Address :</label>
                                <input name="current_address" id="current_address" type="text" class="form-control"
                                       value="{{old('current_address')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permanent_address">Permanent Number :</label>
                                <input name="permanent_address" type="text" id="permanent_address"
                                       class="form-control" value="{{old('permanent_address')}}" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Nationality :</label>
                                <input name="nationality" id="nationality" type="text" class="form-control"
                                       value="{{old('nationality')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="national_id">National ID :</label>
                                <input name="national_id" type="text" id="national_id" class="form-control"
                                       value="{{old('national_id')}}" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marital_status">Marital Status:</label>
                                <select name="marital_status" id="marital_status" class="custom-select form-control"
                                        required>
                                    <option value="0">Unmarried</option>
                                    <option value="1">Married</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">Date of Birth :</label>
                                <input type="text" name="dob" id="dob" class="form-control date-picker"
                                       value="{{old('dob')}}"
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
                                <label for="gender_id">Gender:</label>
                                <select name="gender_id" id="gender_id" class="custom-select form-control" required>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}" {{(old('gender_id') == $gender->id?'selected':'')}}>
                                            {{ $gender->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="religion_id">Religion:</label>
                                <select name="religion_id" id="religion_id" class="custom-select form-control"
                                        required>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion->id }}" {{(old('religion_id') == $religion->id?'selected':'')}}>
                                            {{ $religion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="blood_group">Blood Group:</label>
                                <select name="blood_group_id" id="blood_group" class="custom-select form-control"
                                        required>
                                    @foreach ($bloodGroups as $bloodGroup)
                                        <option value="{{ $bloodGroup->id }}" {{(old('blood_group_id') == $bloodGroup->id?'selected':'')}}>
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

                <section>
                    <div class="row">
                        <div class="col text-right">
                            <input type="submit" value="Add" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

