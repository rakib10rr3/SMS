@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">
    {{--<link rel="stylesheet" type="text/css" href="src/plugins/switchery/dist/switchery.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/dist/switchery.css')}}">--}}
    {{--<!-- bootstrap-tagsinput css -->--}}
    {{--<link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">--}}

    {{--<!-- bootstrap-touchspin css -->--}}
    {{--<link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}">--}}
@endsection

@section('content')

    <div class="min-height-200px">


        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <h4 class="text-blue">Add Subject</h4>
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


                <form id="form" method="post" enctype="multipart/form-data" action="{{ route('subjects.update',$subject->id) }}"
                      class="tab-wizard wizard-circle wizard">
                    @csrf
                    @method('PUT')
                    <h5> Subject Info </h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class :</label>
                                    <select name="the_class_id" class="form-control">
                                        <option value="{{ $subject->the_class_id }}">{{ $subject->theClass->name }}</option>
                                        @foreach($classes as $class)
                                            @if($class->id!=$subject->the_class_id)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Group :</label>
                                    <select name="group_id" class="form-control">
                                        <option value="{{ $subject->group_id }}">{{ $subject->group->name }}</option>
                                        @foreach($groups as $group)
                                            @if($group->id!=$subject->group_id)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $subject->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Code:</label>
                                    <input type="text" name="code" class="form-control" value="{{ $subject->code }}">
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h5> Marks Info </h5>
                    <section>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Full marks:</label>
                                    <input type="text" name="full_marks" class="form-control" value="{{ $subject->full_marks }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Pass marks:</label>
                                    <input type="text" name="pass_marks" class="form-control" value="{{ $subject->pass_marks }}">
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Others</h5>
                    <section>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="has_written">Has written?</label>
                                    <input type="checkbox" name="has_written" id="written" value="{{ ($subject->has_written == 1)?'1':'0' }}" {{ ($subject->has_written == 1)?'checked':''}}>
                                </div>
                            </div>
                        </div>
                        <div id="written_hidden" style="display: {{ ($subject->has_written == 1)?'':'none'}}">
                            <div>
                                <label>Written Full Marks:</label>
                                <input type="text" name="written_marks" class="form-control"
                                       value="{{ $subject->written_marks }}">
                            </div>
                            <div>
                                <label>Written Pass Marks:</label>
                                <input type="text" name="written_pass_marks" class="form-control"
                                       value="{{ $subject->written_pass_marks }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="has_mcq">Has MCQ?</label>
                                    <input type="checkbox" name="has_mcq" id="mcq" value="{{ ($subject->has_mcq == 1)?'1':'0' }}" {{ ($subject->has_mcq == 1)?'checked':''}}>
                                </div>
                            </div>
                        </div>
                        <div id="mcq_hidden" style="display: {{ ($subject->has_mcq == 1)?'':'none'}}">
                            <div>
                                <label>MCQ Full Marks:</label>
                                <input type="text" name="mcq_marks" class="form-control" value="{{ $subject->mcq_marks }}">
                            </div>
                            <div>
                                <label>MCQ Pass Marks:</label>
                                <input type="text" name="mcq_pass_marks" class="form-control"
                                       value="{{ $subject->mcq_pass_marks }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="has_practical">Has practical?</label>
                                    <input type="checkbox" name="has_practical" id="practical" value="{{ ($subject->has_practical == 1)?'1':'0' }}" {{ ($subject->has_practical == 1)?'checked':''}}>
                                </div>
                            </div>
                        </div>
                        <div id="practical_hidden" style="display: {{ ($subject->has_practical == 1)?'':'none'}}">
                            <div>
                                <label>Practical Full Marks:</label>
                                <input type="text" name="practical_marks" class="form-control"
                                       value="{{ $subject->practical_marks }}">
                            </div>
                            <div>
                                <label>Practical Pass Marks:</label>
                                <input type="text" name="practical_pass_marks" class="form-control"
                                       value="{{ $subject->practical_pass_marks }}">
                            </div>
                        </div>
                        <div>
                            <label for="is_optional">Is optional?</label>
                            <input type="checkbox" name="is_optional" id="optional" value="{{ ($subject->is_optional == 1)?'1':'0' }}" {{ ($subject->is_optional == 1)?'checked':''}}>
                        </div>
                    </section>
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



    <!-- Form wizard Js  -->
@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
                // $('#success-modal').modal('show');
                $("#form").submit();
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script>
        // $("#written_hidden").hide();
        $(document).ready(function () {
            $("#written").click(function () {
                if ($("#written").prop("checked")) {
                    $("#written_hidden").show();
                } else {
                    $("#written_hidden").hide();
                }
            });
        });
    </script>

    <script>
        $("#written").on('change', function () {
            if ($(this).is(':checked')) {
                $(this).attr('value', '1');
            }
            else {
                $(this).attr('value', '0');
            }
        });
    </script>

    <script>
        // $("#mcq_hidden").hide();
        $(document).ready(function () {
            $("#mcq").click(function () {
                if ($("#mcq").prop("checked")) {
                    $("#mcq_hidden").show();
                } else {
                    $("#mcq_hidden").hide();
                }
            });
        });
    </script>

    <script>
        $("#mcq").on('change', function () {
            if ($(this).is(':checked')) {
                $(this).attr('value', '1');
            }
            else {
                $(this).attr('value', '0');
            }
        });
    </script>

    <script>
        // $("#practical_hidden").hide();
        $(document).ready(function () {
            $("#practical").click(function () {
                if ($("#practical").prop("checked")) {
                    $("#practical_hidden").show();
                } else {
                    $("#practical_hidden").hide();
                }
            });
        });
    </script>

    <script>
        $("#practical").on('change', function () {
            if ($(this).is(':checked')) {
                $(this).attr('value', '1');
            }
            else {
                $(this).attr('value', '0');
            }
        });
    </script>

    <script>
        $("#optional").on('change', function () {
            if ($(this).is(':checked')) {
                $(this).attr('value', '1');
            }
            else {
                $(this).attr('value', '0');
            }
        });
    </script>

@endsection


@endsection


{{--@extends('layouts.app')--}}

{{--@section('content')--}}

    {{--@if ($errors->any())--}}
        {{--<div class="alert alert-danger">--}}
            {{--<ul>--}}
                {{--@foreach ($errors->all() as $error)--}}
                    {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--@endif--}}
    {{--<form action="{{ route('subjects.update',$subject->id) }}" method="POST">--}}
        {{--@csrf--}}
        {{--@method('PUT')--}}
        {{--<div>--}}
            {{--<div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Select Class:</strong>--}}
                        {{--<select name="class_id" class="form-control">--}}
                            {{--@foreach($classes as $class)--}}
                                {{--<option value="{{$class->id}}">{{$class->name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Subject Name:</strong>--}}
                        {{--<input type="text" name="name" class="form-control" value="{{ $subject->name }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Subject Code:</strong>--}}
                        {{--<input type="text" name="code" class="form-control" value="{{ $subject->code }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Full marks:</strong>--}}
                        {{--<input type="text" name="full_marks" class="form-control" value="{{ $subject->full_marks }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Pass marks:</strong>--}}
                        {{--<input type="text" name="pass_marks" class="form-control" value="{{ $subject->pass_marks }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Written Pass Marks:</strong>--}}
                        {{--<input type="text" name="written_pass_marks" class="form-control" value="{{ $subject->written_pass_marks }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>MCQ Pass Marks:</strong>--}}
                        {{--<input type="text" name="mcq_pass_marks" class="form-control" value="{{ $subject->mcq_pass_marks }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<div>--}}
                        {{--<strong>Practical Pass Marks:</strong>--}}
                        {{--<input type="text" name="practical_pass_marks" class="form-control" value="{{ $subject->practical_pass_marks }}">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}



{{--@endsection--}}