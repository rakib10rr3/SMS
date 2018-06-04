@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
@endsection

@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="form-group pd-20 bg-white border-radius-4 box-shadow mb-30">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Students Information</h5>

            </div>
        </div>
        <div class="row">
            <table id="students_table" class="data-table stripe hover nowrap" style="width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Local Guardian's Cell</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
                <tbody id="body">
                @if(empty($students))
                @else
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->user->username}}</td>
                            <td>{{$student->roll}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->theClass->name}}</td>
                            <td>{{$student->section->name}}</td>
                            <td>{{$student->is_active}}</td>

                            <td>{{$student->group->name}}</td>

                            <td><img src="/images/{{$student->user_id}}/{{$student->photo}}" class="img-responsive"
                                     alt="Student Photo"></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/students/{{$student->id}}/edit"><i
                                                    class="fa fa-pencil"></i> Edit</a>

                                        <a class="dropdown-item ts-delete" href="" data-id="{{$student->id}}"
                                           data-user_id= {{$student->user_id}}><i
                                                    class="fa fa-pencil"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>

    </div>

@endsection


@section('scripts')

    <script src="/src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="/src/plugins/datatables/media/js/dataTables.responsive.js"></script>
    <script src="/src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
    <!-- buttons for Export datatable -->
    <script src="/src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.print.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.html5.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.flash.js"></script>
    <script src="/src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
    <script src="/src/plugins/datatables/media/js/button/vfs_fonts.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
        $(document).ready(function () {
            $("#btn-generate").click(function (e) {
                e.preventDefault();
                //disable buttons and states
                disable();
                var _token = $("input[name='_token']").val();
                var the_class_id = {"class": $('#the_class_id option:selected').val()};
                var section_id = {"section": $('#section_id option:selected').val()};
                var group_id = {"group": $('#group_id option:selected').val()};
                var shift_id = {"shift": $('#shift_id option:selected').val()};
                var session = {"session": $("#session_year").val()};

                console.log(the_class_id);
                console.log(section_id);
                console.log(group_id);
                console.log(shift_id);
                console.log(session);


                $.ajax({
                    url: "{{route('getStudentListFromStudentController')}}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        the_class_id: the_class_id,
                        section_id: section_id,
                        group_id: group_id,
                        shift_id: shift_id,
                        session_year: session,
                    },
                    success: function (data) {
                        console.log(data);
                        var opening;
                        var activeStatus;
                        var ending;

                        var table = $('#students_table').DataTable();
                        if ($.isEmptyObject(data.error)) {
                            console.log(data);
                            //var dropdown = ;
                            //enable button and states
                            enable();
                            $.each(data, function (index, element) {

                                if (element.is_active == 1) {
                                    opening = '<p id=\"active\" class=\"badge badge-success\">';
                                    activeStatus = "Active";
                                } else {
                                    opening = '<p id=\"active\" class=\"badge badge-danger\">';
                                    activeStatus = "Inactive";

                                }

                                table.row.add([
                                    element.username,
                                    element.roll,
                                    element.name,
                                    element.father_name,
                                    element.mother_name,
                                    element.local_guardian_cell,
                                   '<img height="50px" width="50px" src="images/students/' + element.photo + ' " class="img-rounded"alt="Student Photo">',
                                    opening + activeStatus + '</p>',
                                    '<div class="dropdown">\n' +
                                    '<a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"\n' +
                                    ' data-toggle="dropdown">\n' +
                                    '<i class="fa fa-ellipsis-h"></i>\n' +
                                    '</a>\n' +
                                    '<div class="dropdown-menu dropdown-menu-right">\n' +
                                    '<a href="/students/' + element.id + '/edit" class="dropdown-item"><i\n' +
                                    ' class="fa fa-pencil"></i> Edit</a>\n' +
                                    '<a class="dropdown-item ts-delete" data-id="' + element.id + '" href=""><i\n' +
                                    ' class="fa fa-pencil"></i> Delete</a>\n' +
                                    '</div>\n' +
                                    '</div>'
                                ]).draw(false);
                            });
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });
        });

        function enable() {
            $('#btn-generate').html("Get Student List").prop('disabled', false).removeClass('btn btn-warning').addClass('btn btn-success');
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
            $("#group_id").prop("disabled", true);
        }
    </script>


    <script>
        $(document).on('click', '.ts-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var userId = $(this).data('user_id');

            console.log(id);
            swal({
                title: "Are you sure!",
                type: "error",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "/students/" + id,
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: "DELETE",
                                user_id: userId,

                            },
                            success: function (data) {
                                swal("Poof! Your imaginary file has been deleted!", {
                                    icon: "success",
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>


@endsection


{{--@include('layouts.header')--}}




