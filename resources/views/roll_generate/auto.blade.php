@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Generate Auto Roll</h5>

            </div>
        </div>
        <div class="col-md-4 col-sm-12">

        </div>

        <div class="form-group">
            <form id="multi">
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
                    {{--<div class="col">--}}
                    {{--<div class="form-group">--}}
                    {{--<label>Group:</label>--}}
                    {{--<select name="group_id" class="custom-select form-control">--}}
                    {{--@foreach ($groups as $group)--}}
                    {{--<option value="{{ $group->id }}">--}}
                    {{--{{ $group->name }}--}}
                    {{--</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                </div>

                <button id="btn-generate" name="btn-generate" class="btn btn-success">Generate</button>
            </form>
        </div>
        {{--@endif--}}
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="container">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h5 class="text-blue">Students List</h5>
                </div>
            </div>
            <div class="row">
                <table id="students_table" class="stripe hover multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Local Guardian's Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(empty($students))
                    @else
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->father_name}}</td>
                                <td>{{$student->mother_name}}</td>
                                <td>{{$student->local_guardian_name}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script src="{{asset('src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{asset('src/plugins/datatables/media/js/button/dataTables.buttons.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.print.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.html5.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.flash.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/pdfmake.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/vfs_fonts.js')}}"></script>







    <script>
        $(document).ready(function () {
            $("#btn-generate").click(function (e) {
                e.preventDefault();
                //disable buttons and states
                disable();
                var _token = $("input[name='_token']").val();
                var the_class_id = {"class": $('#the_class_id option:selected').val()};
                var section_id = {"section": $('#section_id option:selected').val()};
                var shift_id = {"shift": $('#shift_id option:selected').val()};
                var group_id = {"group": $('#group_id option:selected').val()};

                $.ajax({
                    url: "{{route('autoRollList')}}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        the_class_id: the_class_id,
                        section_id: section_id,
                        shift_id: shift_id,
                        group_id: group_id
                    },
                    success: function (data) {
                        var table = $('#students_table').DataTable();
                        if ($.isEmptyObject(data.error)) {
                            console.log(data);
                            console.log(section_id);
                            console.log(shift_id);
                            //enable button and states
                            enable();
                            $.each(data, function (index, element) {
                                //subject.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                                table.row.add([
                                    element.roll,
                                    element.name,
                                    element.father_name,
                                    element.mother_name,
                                    element.local_guardian_name,
                                ]).draw(false);
                                //  $("#students_table").find('tbody').append('<tr>' + '<td>' + element.roll + '</td>' + '<td>' + element.name + '<td>' + element.father_name + '<td>' + element.mother_name + '</td>' + '<td>' + element.local_guardian_name + '</td>' + '</tr>');
                                console.log(element.roll);
                            });

                        } else {
                            printErrorMsg(data.error);
                        }

                    }
                });
            });
        });

        function enable() {
            $('#btn-generate').html("Generate").prop('disabled', false).removeClass('btn btn-warning').addClass('btn btn-success');
            $("#the_class_id").prop("disabled", false);
            $("#section_id").prop("disabled", false);
            $("#shift_id").prop("disabled", false);
            $("#group_id").prop("disabled", false);
        }

        function disable() {
            $("#students_table").DataTable().clear().draw();
            $('#btn-generate').html("Wait...").prop('disabled', true).removeClass('btn btn-success').addClass('btn btn-warning');
            $("#the_class_id").prop("disabled", true);
            $("#section_id").prop("disabled", true);
            $("#shift_id").prop("disabled", true);
            $("#group_id").prop("disabled", false);

        }
    </script>

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
@endsection


{{--@include('layouts.header')--}}








