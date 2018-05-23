@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">
@endsection

@section('content')

    <div class="min-height-200px">


        <div class="col">
            <div class="pd-20 bg-white border-radius-4 box-shadow">
                <h5 class="weight-500 mb-20">Send Sms</h5>
                <div class="tab">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home2" role="tab" aria-selected="true">Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-selected="false">Teacher</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-selected="false">Custom</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile4" role="tab" aria-selected="false">Balance</a>
                        </li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home2" role="tabpanel">
                            <div class="pd-20">
                                <form action="{{route('sendSms.create')}}" method="post">

                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Class:</label>
                                                <select name="the_class_id" class="custom-select form-control">
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Section:</label>
                                                <select name="section_id" class="custom-select form-control">
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}">
                                                            {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-2 col-form-label">Shift:</label>
                                                <select class="form-control" id="shift_id"
                                                        name="shift_id">
                                                    @foreach($shifts as $shift)
                                                        <option value="{{$shift->id}}">{{$shift->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <input value="student" type="hidden" name="type"/>

                                    <button type="submit" name="submit" class="btn btn-outline-success">Next</button>
                                </form>
                            </div>
                        </div>

                        <!----------------  For  Tab  2----------------------------------------------------->
                        <div class="tab-pane fade" id="profile2" role="tabpanel">
                            <div class="pd-20">


                                <form action="{{route('sendSms.create')}}" method="post">

                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Class:</label>
                                                <select name="the_class_id" id="theclass"
                                                        class="custom-select form-control">
                                                    <option selected value=""> All</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-sm-12 col-md-2 col-form-label">Subject:</label>
                                                <select class="form-control" id="subject"
                                                        name="subject_id">
                                                    <option selected value="">All</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Section:</label>
                                                <select name="section_id" class="custom-select form-control">
                                                    <option selected value="">
                                                        All
                                                    </option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}">
                                                            {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <input value="teacher" type="hidden" name="type"/>
                                    <button type="submit" name="submit" class="btn btn-outline-success">Next</button>
                                </form>


                            </div>
                        </div>

                        <!----------------  For  Tab  3----------------------------------------------------->

                        <div class="tab-pane fade" id="profile3" role="tabpanel">
                            <div class="pd-20">
                                <form action="{{route('sendSms.create')}}" method="post">

                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Numbers :</label>
                                                <input name="to" type="text" class="form-control"
                                                       placeholder=" 01xxxxxxxxx,01xxxxxxxxx....">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Message :</label>
                                                <input name="message" id="message" type="text" class="form-control"
                                                       placeholder="Message">
                                            </div>
                                        </div>
                                    </div>

                                    <input value="4d4419ddc0bc3324187600e2d19911cd" type="hidden" name="token"/>

                                    <button type="submit" name="submit" class="btn btn-outline-success">Send Message
                                    </button>

                                </form>
                            </div>
                        </div>

                        <!-----------------------------  For Tab 4 -------------------------------------- -->

                        <div class="tab-pane fade" id="profile4" role="tabpanel">
                            <div class="pd-20">
                                <form action="{{route('sendSms.balance')}}" method="get" id="check_balance">
                                    @csrf
                                    <button type="submit" name="submit" class="btn btn-outline-success">Check Balance
                                    </button>
                                </form>
                            </div>

                            <div id="sms_result" class="card-body alert alert-success">
                                Sms result will be shown here
                            </div>

                        </div>

                    </div>
                </div>
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





    <script type="text/javascript">

        $(document).ready(function ($) {

            $('#sms_result').hide();
            $('#theclass').change(function () {
                $class_id = $(this).val();

                $.get("/api/subjects/" + $class_id,

                    function (data) {
                        var subject = $('#subject');
                        subject.empty();
                        subject.append("<option value=''>All</option>");
                        $.each(data, function (index, element) {
                            subject.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    });
            });

            $("#check_balance").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/sendSms/balance",

                    success: function (data) {
                        console.log(data);
                        $("#sms_result").text(data).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });


        });

    </script>

@endsection


@endsection
