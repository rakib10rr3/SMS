@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="/src/plugins/jquery-steps/build/jquery.steps.css">

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
                                    <select name="the_class_id" class="form-control" required>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Group :</label>
                                    <select name="group_id" class="form-control" required>
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
                                    <input type="text" name="name" class="form-control" placeholder="Subject Name" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Code:</label>
                                    <input type="text" name="code" class="form-control" placeholder="Subject Code" required/>
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
                                    <input type="text" name="full_marks" class="form-control" placeholder="Full Marks" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Pass marks:</label>
                                    <input type="text" name="pass_marks" class="form-control" placeholder="Pass Marks" required>
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
