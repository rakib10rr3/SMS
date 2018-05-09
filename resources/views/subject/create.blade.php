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


                <form id="form" method="post" enctype="multipart/form-data" action="{{ route('subjects.store') }}"
                      class="tab-wizard wizard-circle wizard">
                    @csrf

                    <h5> Subject Info </h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class :</label>
                                    <select name="the_class_id" class="form-control">
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Group :</label>
                                    <select name="group_id" class="form-control">
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Subject Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Code:</label>
                                    <input type="text" name="code" class="form-control" placeholder="Subject Code">
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
                                    <input type="text" name="full_marks" class="form-control" placeholder="Full Marks">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Pass marks:</label>
                                    <input type="text" name="pass_marks" class="form-control" placeholder="Pass Marks">
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
                                    <input type="checkbox" check="uncheck" name="has_written" id="written" value="0">
                                </div>
                            </div>
                        </div>
                        <div id="written_hidden" style="display: none">
                            <div>
                                <label>Written Full Marks:</label>
                                <input type="text" name="written_marks" class="form-control"
                                       placeholder="Written Marks">
                            </div>
                            <div>
                                <label>Written Pass Marks:</label>
                                <input type="text" name="written_pass_marks" class="form-control"
                                       placeholder="Written Pass Marks">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="has_mcq">Has MCQ?</label>
                                    <input type="checkbox" name="has_mcq" id="mcq" value='0'>
                                </div>
                            </div>
                        </div>
                        <div id="mcq_hidden" style="display: none">
                            <div>
                                <label>MCQ Full Marks:</label>
                                <input type="text" name="mcq_marks" class="form-control" placeholder="MCQ Marks">
                            </div>
                            <div>
                                <label>MCQ Pass Marks:</label>
                                <input type="text" name="mcq_pass_marks" class="form-control"
                                       placeholder="MCQ Pass Marks">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="has_practical">Has practical?</label>
                                    <input type="checkbox" name="has_practical" id="practical" value='0'>
                                </div>
                            </div>
                        </div>
                        <div id="practical_hidden" style="display: none">
                            <div>
                                <label>Practical Full Marks:</label>
                                <input type="text" name="practical_marks" class="form-control"
                                       placeholder="Practical Marks">
                            </div>
                            <div>
                                <label>Practical Pass Marks:</label>
                                <input type="text" name="practical_pass_marks" class="form-control"
                                       placeholder="Practical Pass Marks">
                            </div>
                        </div>
                        <div>
                            <label for="is_optional">Is optional?</label>
                            <input type="checkbox" name="is_optional" id="optional" value='0'>
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
        //$("#written_hidden").hide();
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

{{--@section('styles')--}}
{{--<link rel="stylesheet" type="text/css" href="src/plugins/switchery/dist/switchery.css">--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/dist/switchery.css')}}">--}}
{{--<!-- bootstrap-tagsinput css -->--}}
{{--<link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">--}}

{{--<!-- bootstrap-touchspin css -->--}}
{{--<link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css">--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}">--}}


{{--@endsection--}}
{{--@section('content')--}}
{{--@if ($errors->any())--}}
{{--<div>--}}
{{--<ul>--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}

{{--<form action="{{ route('subjects.store') }}" method="POST">--}}
{{--@csrf--}}
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
{{--<strong>Select Group:</strong>--}}
{{--<select name="group_id" class="form-control">--}}
{{--@foreach($groups as $group)--}}
{{--<option value="{{$group->id}}">{{$group->name}}</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div>--}}
{{--<div>--}}
{{--<strong>Subject Name:</strong>--}}
{{--<input type="text" name="name" class="form-control" placeholder="Subject Name">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div>--}}
{{--<div>--}}
{{--<strong>Subject Code:</strong>--}}
{{--<input type="text" name="code" class="form-control" placeholder="Subject Code">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div>--}}
{{--<div>--}}
{{--<strong>Full marks:</strong>--}}
{{--<input type="text" name="full_marks" class="form-control" placeholder="Full Marks">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div>--}}
{{--<div>--}}
{{--<strong>Pass marks:</strong>--}}
{{--<input type="text" name="pass_marks" class="form-control" placeholder="Pass Marks">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="mb-30">--}}
{{--<strong>Has written part?</strong>--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#a683eb">--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#f2a654">--}}
{{--<input type="checkbox" class="switch-btn" data-color="#0059b2" id="written">--}}
{{--</div>--}}
{{--<div id="written_hidden">--}}
{{--<div>--}}
{{--<strong>Written Full Marks:</strong>--}}
{{--<input type="text" name="written_marks" class="form-control" placeholder="Written Pass Marks">--}}
{{--</div>--}}
{{--<div>--}}
{{--<strong>Written Pass Marks:</strong>--}}
{{--<input type="text" name="written_pass_marks" class="form-control" placeholder="Written Pass Marks">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="mb-30">--}}
{{--<strong>Has MCQ part?</strong>--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#a683eb">--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#f2a654">--}}
{{--<input type="checkbox" class="switch-btn" data-color="#0059b2">--}}
{{--</div>--}}
{{--<div id="mcq_hidden">--}}
{{--<div>--}}
{{--<strong>MCQ Full Marks:</strong>--}}
{{--<input type="text" name="mcq_marks" class="form-control" placeholder="Written Pass Marks">--}}
{{--</div>--}}
{{--<div>--}}
{{--<strong>MCQ Pass Marks:</strong>--}}
{{--<input type="text" name="mcq_pass_marks" class="form-control" placeholder="MCQ Pass Marks">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="mb-30">--}}
{{--<strong>Has Practical part?</strong>--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#a683eb">--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#f2a654">--}}
{{--<input type="checkbox" class="switch-btn" data-color="#0059b2">--}}
{{--</div>--}}
{{--<div id="practical_hidden">--}}
{{--<div>--}}
{{--<strong>Practical Full Marks:</strong>--}}
{{--<input type="text" name="practical_marks" class="form-control" placeholder="Written Pass Marks">--}}
{{--</div>--}}
{{--<div>--}}
{{--<strong>Practical Pass Marks:</strong>--}}
{{--<input type="text" name="practical_pass_marks" class="form-control" placeholder="Practical Pass Marks">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="mb-30">--}}
{{--<strong>Is optional?</strong>--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#a683eb">--}}
{{--<input type="checkbox" checked class="switch-btn" data-color="#f2a654">--}}
{{--<input type="checkbox" class="switch-btn" data-color="#0059b2">--}}
{{--</div>--}}
{{--<div>--}}
{{--<button type="submit" class="btn btn-primary">Submit</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}
{{--@endsection--}}
{{--@section('scripts')--}}

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

{{--<script src="src/plugins/switchery/dist/switchery.js"></script>--}}
{{--<script src="{{asset('src/plugins/switchery/dist/switchery.js')}}"></script>--}}
{{--<!-- bootstrap-tagsinput js -->--}}
{{--<script src="src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>--}}
{{--<script src="{{asset('src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>--}}
{{--<!-- bootstrap-touchspin js -->--}}
{{--<script src="src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>--}}
{{--<script src="{{asset('src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}"></script>--}}
{{--<script>--}}
{{--// Switchery--}}
{{--var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));--}}
{{--$('.switch-btn').each(function() {--}}
{{--new Switchery($(this)[0], $(this).data());--}}
{{--});--}}

{{--// Bootstrap Touchspin--}}
{{--$("input[name='demo_vertical2']").TouchSpin({--}}
{{--verticalbuttons: true,--}}
{{--verticalupclass: 'fa fa-plus',--}}
{{--verticaldownclass: 'fa fa-minus'--}}
{{--});--}}
{{--$("input[name='demo3']").TouchSpin();--}}
{{--$("input[name='demo1']").TouchSpin({--}}
{{--min: 0,--}}
{{--max: 100,--}}
{{--step: 0.1,--}}
{{--decimals: 2,--}}
{{--boostat: 5,--}}
{{--maxboostedstep: 10,--}}
{{--postfix: '%'--}}
{{--});--}}
{{--$("input[name='demo2']").TouchSpin({--}}
{{--min: -1000000000,--}}
{{--max: 1000000000,--}}
{{--stepinterval: 50,--}}
{{--maxboostedstep: 10000000,--}}
{{--prefix: '$'--}}
{{--});--}}
{{--$("input[name='demo3_22']").TouchSpin({--}}
{{--initval: 40--}}
{{--});--}}
{{--$("input[name='demo5']").TouchSpin({--}}
{{--prefix: "pre",--}}
{{--postfix: "post"--}}
{{--});--}}
{{--</script>--}}
{{--<script src="https://code.jquery.com/jquery-1.11.3.js"></script>--}}
{{--<script>--}}
{{--$(document).ready(function(){--}}
{{--$("#written").click(function (){--}}
{{--if ($("#written").prop("checked")){--}}
{{--$("#written_hidden").hide();--}}
{{--}else{--}}
{{--$("#written_hidden").show();--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--</script>--}}

{{--@endsection--}}

