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
            @page {
                margin: 0;
            }

            body {
                margin: 0;
            }

        }

    </style>


@endsection

@section('content')




    <button id="print" class="btn float-right" onclick="myPrint()">Print</button>

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="img-preview">
            <a href="/">
                <img src="/vendors/images/logo-full-color.png" alt="Logo">
            </a>
        </div>

        <h2 class="text-center"><strong>School: </strong>{{$school_name->value}}</h2>
        <h3 class="text-center"> {{$address->value}}</h3>
        <hr>

        <h5 class="text-blue text-center"> Merit List - {{$exam_term}} - {{$session}}</h5>


        <div style="text-align: center" ;>
            <div class="row ">

                <div class="col ">

                    <h6><strong>Class: </strong> {{ $class_name }}</h6>

                </div>

                <div class="col">
                    <h6><strong>Group: </strong> {{ $group_name }} </h6>

                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h6><strong>Shift: </strong> {{ $shift_name  }} </h6>
                </div>
                <div class="col">
                    <h6><strong> Section: </strong>{{  $section_name}} </h6>
                </div>
            </div>

        </div>

        <div class="row" style="padding: 10px">

            <table id="mytable" class="table table-striped table-bordered">
                <thead>
                <tr>

                    <th>Rank</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Roll</th>
                    <th>Total</th>
                    <th>Point</th>
                </tr>
                </thead>
                <tbody>


                @if(empty($students))

                    <p>Data does not exist</p>
                @elseif( $groupFlag=="on")

                    @foreach($students as $student)
                        @if($student->student->group->name ==$group_name )
                            <tr>
                                <td class="table-plus">{{$loop->iteration}}</td>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->student->name }}</td>
                                @if($student->roll==null)
                                    <td>No previous record</td>
                                @else
                                    <td>{{ $student->roll }}</td>
                                @endif
                                <td>{{ $student->total_marks }}</td>
                                <td>{{ $student->point }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    @foreach($students as $student)
                        <tr>
                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->student->name }}</td>
                            @if($student->roll==null)
                                <td>No previous record</td>
                            @else
                                <td>{{ $student->roll }}</td>
                            @endif
                            <td>{{ $student->total_marks }}</td>
                            <td>{{ $student->point }}</td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>


    <div class="float-left">
        Printed By Kda-It
    </div>

    <div class="float-right">
        Software Developed and Managed By - KDA IT
    </div>




    <script>

        function myPrint() {
            window.print();
        }

        // $(document).ready(function () {
        //     myPrint();
        // });

    </script>


@endsection



