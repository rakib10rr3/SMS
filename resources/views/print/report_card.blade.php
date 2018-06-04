@extends('layouts.app')

@section('styles')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/vendors/styles/style.css">
    <link rel="stylesheet" href="/vendors/styles/custom.css">

    <style type="text/css">

        @media print {

            body {
                visibility: hidden;
            }

            .print-this {
                visibility: visible;
            }

            .page-break {
                page-break-before: always;
            }
        }

        @media all {
            /*.page-break {*/
            /*display: none;*/
            /*}*/
        }

        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }


    </style>


@endsection

@section('content')


    {{--{{dd($merit_lists)}}--}}

    <button id="print" class="btn float-right" onclick="myPrint()">Print</button>

    <div class="print-this">


        @foreach($student_array as $student_obj)

            <div class="printthis pd-20 bg-white border-radius-4 box-shadow mb-30">

                <div class="img-preview">
                    <a href="/">
                        <img src="/vendors/images/logo-full-color.png" alt="Logo">
                    </a>
                </div>

                <h2 class="text-center"><strong>School: </strong>{{$school_name->value}}</h2>

                <h3 class="text-center"> {{$address->value}}</h3>

                <hr>

                <h5 class="text-blue text-center"> Merit List - {{$exam_term}}-{{$session}} </h5>


                <div style="text-align: center ; border: 1px solid black; padding: 10px ; margin: 10px " ;>

                    <div class="row">

                        <div class="col">

                            <img src="images/{{$student_obj->id}}/{{$student_obj->photo}}" class="img-responsive"
                                 alt="No image Found">

                        </div>
                        <div class="col">
                            <div class="row">

                                <h6><strong>Name: </strong> {{ $student_obj->name }}</h6>
                            </div>

                            <div class="row">

                                <h6><strong>Student Id: </strong> {{  $student_obj->id }}</h6>

                            </div>

                        </div>
                        <div class="col">

                            <div class="row">
                                <h6><strong>Class: </strong> {{ $class_name }}</h6>

                            </div>

                            <div class="row">
                                <h6><strong>Group: </strong> {{ $group_name }} </h6>

                            </div>

                        </div>

                        <div class="col">

                            <div class="row">
                                <h6><strong>Shift: </strong> {{ $shift_name  }} </h6>

                            </div>

                            <div class="row">
                                <h6><strong> Section: </strong>{{  $section_name}} </h6>

                            </div>

                        </div>

                    </div>
                </div>


                <div class="row" style="padding: 10px">

                    <table id="mytable" class="table  table-bordered" style="text-align: center;">
                        <thead>
                        <tr>

                            <th rowspan="2">Subject</th>
                            <th colspan="7">{{$exam_term}}</th>


                        </tr>

                        <tr>


                            <th>Written</th>
                            <th>MCQ</th>
                            <th>Practical</th>
                            <th>Total</th>
                            <th>Highest Mark</th>
                            <th>Letter Grade</th>
                            <th>Grade Point</th>


                        </tr>

                        </thead>
                        <tbody>
                        @foreach($students as $student)

                            @if($student->student_id==$student_obj->id)
                                <tr>
                                    <td>{{$student->subject->name}}</td>
                                    <td>{{$student->written}}</td>
                                    <td>{{$student->mcq}}</td>
                                    <td>{{$student->practical}}</td>
                                    <td>{{$student->written +$student->mcq+$student->practical }}</td>
                                    <td> {{$highest_mark[$student->subject_id]}} </td>
                                    <td>{{$student->grade->name}}</td>
                                    <td>{{$student->point}}</td>

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="row">
                    @foreach($merit_lists as $merit_list)
                        @if($merit_list->student_id == $student_obj->id)
                            <div class="col">
                                <h6><strong> GPA: </strong>{{  $merit_list->point }} </h6>
                            </div>
                            <div class="col">
                                <strong> Grade: </strong>{{  $merit_list->grade->name }} </h6>
                            </div>
                            <div class="col">
                                <strong> Total Marks: </strong>{{  $merit_list->total_marks }} </h6>
                            </div>

                        @endif
                    @endforeach
                </div>
                <div class="row" style="margin: 10px">
                    <div class="col">

                        Printed by {{ Auth::user()->username }}
                    </div>

                    <div class="col">
                        Prottoy - Education Management Software
                    </div>

                    <div class="col">
                        Developed & Managed By- KDA IT
                    </div>

                </div>


                @if(!$loop->last)
                    <div class="page-break">

                    </div>
                @endif


            </div>


        @endforeach


        <script>

            function myPrint() {
                window.print();
            }

        </script>
    </div>

@endsection








