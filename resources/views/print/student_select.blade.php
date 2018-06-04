@extends('layouts.app')
@section('styles')


    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="form-group pd-20 bg-white border-radius-4 box-shadow mb-30">

            <form>
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Class:</label>
                            <select id="the_class_id" class="custom-select2 form-control" name="the_class_id"
                                    style="width: 100%; height: 38px;">
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
                            <select id="section_id" class="custom-select2 form-control" name="section_id"
                                    style="width: 100%; height: 38px;">
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
                            <select id="group_id" class="custom-select2 form-control" name="group_id"
                                    style="width: 100%; height: 38px;">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Shift:</label>
                            <select id="shift_id" class="custom-select2 form-control" name="shift_id"
                                    style="width: 100%; height: 38px;">
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">
                                        {{ $shift->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <label>Session :</label>
                            <input type="number" class="form-control" placeholder="Select Session Year"
                                   id="session_year"
                                   min="2000" max="2099" name="session_year"
                                   value="{{Carbon\Carbon::now()->format('Y')}}" required/>
                        </div>
                    </div>
                </div>

                <button id="btn-generate" name="btn-generate" class="btn btn-success">Get Student List</button>
            </form>
        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <form action="{{route('print.student_print')}}" method="post" >

                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group col-md-6">
                            <label for="exam_term">Exam Term</label>
                            <select class="form-control custom-select" name="exam_term" id="exam_term">
                                @foreach( $examTerms as $exam_term)
                                    <option value="{{ $exam_term->id }}" selected>{{ $exam_term->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="clearfix mb-20">
                    <div class="pull-left">
                        @if(! empty($forClass))
                            <h5 class="text-blue"> Class {{$forClass}}</h5>
                        @endif
                        <h5 class="text-blue">Student Information </h5>

                    </div>
                </div>


                <div class="row">
                    <table id="mytable" class="data-table stripe hover nowrap">
                        <thead>
                        <tr>

                            <th>Roll</th>
                            <th>Student Id</th>
                            <th>Student Name</th>
                            <th>Select</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <button class="btn btn-success">Print Student Result</button>
                </div>

            </form>


        </div>
    </div>







@endsection


@section('scripts')

    {{--<script src="{{asset('src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>--}}
    {{--<script src="{{asset('src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>--}}
    {{--<script src="{{asset('src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>--}}
    {{--<script src="{{asset('src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>--}}
    {{--<!-- buttons for Export datatable -->--}}
    {{--<script src="{{asset('src/plugins/datatables/media/js/button/dataTables.buttons.js')}}></script>--}}
    {{--<script src="{{asset('src/plugins/datatables/media/js/button/buttons.bootstrap4.js')}}></script>--}}


    <script src="{{asset('src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>
    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.print.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.html5.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.flash.js"></script>
    <script src="src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/media/js/button/vfs_fonts.js"></script>


    <script>
        $('document').ready(function () {
            $('.data-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search"
                },
            });
            $('.data-table-export').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search"
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'pdf', 'print'
                ]
            });
            var table = $('.select-row').DataTable();
            $('.select-row tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            var multipletable = $('.multiple-select-row').DataTable();
            $('.multiple-select-row tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
            });
        });
    </script>


    <script>

        $("#btn-generate").click(function (e) {
            e.preventDefault();
            console.log(" Submitted ");
            $button = $(this);
            $button.html("Wait").prop('disabled', true).removeClass('btn btn-outline-success').addClass('btn btn-outline-warning');

            var originalText = $button.text(), i = 0;
            var myTimer = setInterval(function () {

                $button.append(".");
                i++;

                if (i == 4) {
                    $button.html(originalText);
                    i = 0;
                }

            }, 500);


            _token = $("input[name='_token']").val();
            the_class_id = $('#the_class_id :selected').val();
            section_id = $('#section_id :selected').val();
            shift_id = $('#shift_id :selected').val();
            group_id = $('#group_id :selected').val();
            session = $('#session_year').val();
            var cars = new Array();
            cars.push(the_class_id, section_id, shift_id, group_id, session);

            console.log(cars);

            var dataTable = $('#mytable').DataTable();
            $("#mytable").DataTable().clear().draw();

            console.log(the_class_id);


            $.ajax({

                url: "/print/student-show",
                type: 'POST',
                data: {
                    _token: _token,
                    the_class_id: the_class_id,
                    section_id: section_id,
                    shift_id: shift_id,
                    group_id: group_id,
                    session: session,
                },

                success: function (data) {
                    console.log(data);

                    $.each(data, function (index, element) {

                        if (element.is_active == 1) {
                            opening = '<p id=\"active\" class=\"badge badge-success\">';
                            activeStatus = "Active";
                        } else {
                            opening = '<p id=\"active\" class=\"badge badge-danger\">';
                            activeStatus = "Inactive";

                        }

                        dataTable.row.add([
                            element.roll,
                            element.id,
                            element.name,

                            '<td>' +
                            ' <div class="custom-control custom-checkbox mb-5"> ' +
                            ' <input type="checkbox" name="checkbox[]"' +
                            ' value="' + element.id + '"' +
                            'class="custom-control-input"' +
                            'id="' + element.id + '">' +
                            ' <label class="custom-control-label" for="' + element.id + '">Mark</label>' +
                            ' </div>' +

                            ' </td>'
                        ]).draw(false);


                    });
                }

            });

//            $(document).ajaxSend(function (event, request, settings) {
//                $('#loading-indicator').fadeIn();
//            });
//

            $(document).ajaxComplete(function (event, request, settings) {

                clearInterval(myTimer);
                $button.html("Get Student List").prop('disabled', false).removeClass('btn btn-outline-warning').addClass('btn btn-outline-success');

            });

        });


    </script>



@endsection