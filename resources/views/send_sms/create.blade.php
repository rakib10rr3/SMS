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

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home2" role="tabpanel">
                            <div class="pd-20">
                                <form action="/sendSms" method="post">

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
                                                <label>Group:</label>
                                                <select name="group_id" class="custom-select form-control">
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}">
                                                            {{ $group->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>










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

                                    {{--<input value="4d4419ddc0bc3324187600e2d19911cd" type="text" name="token" placeholder="token"--}}
                                    {{--class="form-control"/>--}}

                                    {{--<input type="text" name="to" placeholder="01xxxxxxxxx,01xxxxxxxxx"/>--}}

                                    {{--<textarea class="span11" name="message" id="message"--}}
                                    {{--style="position: relative; left: 4%;"></textarea>--}}


                                    <button type="submit" name="submit" class="btn btn-outline-success">Send Message</button>


                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile2" role="tabpanel">
                            <div class="pd-20">
                                <form action="/sendSms" method="post">

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

                                    {{--<input value="4d4419ddc0bc3324187600e2d19911cd" type="text" name="token" placeholder="token"--}}
                                    {{--class="form-control"/>--}}

                                    {{--<input type="text" name="to" placeholder="01xxxxxxxxx,01xxxxxxxxx"/>--}}

                                    {{--<textarea class="span11" name="message" id="message"--}}
                                    {{--style="position: relative; left: 4%;"></textarea>--}}


                                    <button type="submit" name="submit" class="btn btn-outline-success">Send Message</button>


                                </form>
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

@endsection


@endsection
