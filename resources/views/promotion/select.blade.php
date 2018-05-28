@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">

    <link rel="stylesheet" type="text/css" href="/src/plugins/switchery/dist/switchery.css">
@endsection
@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if(isset($error_message))
        <div class="alert alert-danger" role="alert">
            {{$error_message}}
        </div>
    @endif


    <div class="alert alert-success" role="alert">

        <h4 class="alert-heading">Help</h4>
        <ol>
            <li>Fill <strong>"Promote From"</strong> fields and click <span class="badge badge-success">Select</span>. Then fill <strong>"Promote To"</strong> fields and click <span class="badge badge-success">Promote</span> to promote Students.</li>
            <li>For SSC Passed student enter the Session and check <strong>"Make Inactive"</strong> from <strong>"Promote To"</strong>.</li>
        </ol>

    </div>

    @if($come==1)

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue">Promote From</h4>
                </div>
            </div>
            <form method="post" action="{{ route('promotion.view') }}">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-12 col-md-6 col-form-label">Class:</label>
                            <select id="theclass" class="custom-select2 form-control" name="the_class_id"
                                    style="width: 100%; height: 38px;">
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ (isset($query))?($query["the_class_id"] == $class->id ? "selected":""):"" }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label">Shift:</label>
                            <select class="custom-select2 form-control" id="shift_id" name="shift_id"
                                    style="width: 100%; height: 38px;">
                                <option value="">Select Shift</option>
                                @foreach($shifts as $shift)
                                    <option value="{{$shift->id}}" {{ (isset($query))?($query["shift_id"] == $shift->id ? "selected":""):"" }}>
                                        {{$shift->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label">Section:</label>
                            <select class="custom-select2 form-control" id="section_id" name="section_id"
                                    style="width: 100%; height: 38px;">
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}" {{ (isset($query))?($query["section_id"] == $section->id ? "selected":""):"" }}>
                                        {{$section->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="col-sm-12 col-form-label">Group:</label>
                            <select class="custom-select2 form-control" id="group_id" name="group_id"
                                    style="width: 100%; height: 38px;">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}" {{ (isset($query))?($query["group_id"] == $group->id ? "selected":""):"" }}>
                                        {{$group->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="col-sm-12 col-form-label">Current Session Year:</label>
                            <input value="{{(isset($query))?$query["session"]:(Carbon\Carbon::now()->year - 1)}}"
                                   name="session" class="form-control"
                                   type="number"
                                   min="2000" max="2099" step="1" required/>
                        </div>
                    </div>

                </div>

                <div>
                    {{old('session')}}
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit" value="Add">Select</button>
                    </div>
                </div>
            </form>

        </div>


    @else


        <form method="post" action="{{ route('promotion.update') }}">
            @csrf

            {{--<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">--}}
            <div class="row  pd-20">
                <div class="col-md pd-20 bg-white border-radius-4 box-shadow mb-30">

                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue">Promote From</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-2 col-form-label">Class:</label>
                                <select id="theclass" class="custom-select2 form-control" name="the_class_id"
                                        style="width: 100%; height: 38px;" disabled>
                                    <option value="{{ $class->id }}">
                                        {{ $class->name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-2 col-form-label">Shift:</label>
                                <select class="custom-select2 form-control" id="shift_id" name="shift_id"
                                        style="width: 100%; height: 38px;" disabled>
                                    <option value="{{$shift->id}}">{{$shift->name}}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-2 col-form-label">Section:</label>
                                <select class="custom-select2 form-control" id="section_id" name="section_id"
                                        style="width: 100%; height: 38px;" disabled>
                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-group ">
                                <label class="col-sm-12 col-md-2 col-form-label">Group:</label>
                                <select class="custom-select2 form-control" id="group_id" name="group_id"
                                        style="width: 100%; height: 38px;" disabled>
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="col-sm-12 col-form-label">Current Session Year:</label>
                                <input value="{{$session}}" name="session" class="form-control" type="number"
                                       min="2000" max="2099"
                                       step="1" style="width: 100%; height: 38px;" disabled/>
                            </div>
                        </div>

                    </div>

                </div>
                {{-- ================================================= --}}
                <div class="col-md ml-4 pd-20 bg-white border-radius-4 box-shadow mb-30" id="promote_to">

                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue">Promote To</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-2 col-form-label">Class:</label>
                                <select id="theclass" class="custom-select2 form-control" name="the_class_id"
                                        style="width: 100%; height: 38px;">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-2 col-form-label">Shift:</label>
                                <select class="custom-select2 form-control" id="shift_id" name="shift_id"
                                        style="width: 100%; height: 38px;">
                                    <option value="">Select Shift</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{$shift->id}}">{{$shift->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-2 col-form-label">Section:</label>
                                <select class="custom-select2 form-control" id="section_id" name="section_id"
                                        style="width: 100%; height: 38px;">
                                    <option value="">Select Section</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="col-sm-12 col-md-2 col-form-label">Group:</label>
                                <select class="custom-select2 form-control" id="group_id" name="group_id"
                                        style="width: 100%; height: 38px;">
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
                                <label class="col-sm-12 col-form-label">New Session Year:</label>
                                <input value="{{Carbon\Carbon::now()->year}}" name="session" class="form-control"
                                       type="number" min="2000" max="2099"
                                       step="1" style="width: 100%; height: 38px;" required/>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input id="to_inactive" name="to_inactive" type="checkbox"
                                       class="form-check-input switch-btn" data-color="#e74c3c" value="yes">
                                <label for="to_inactive">Make Inactive</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{--</div>--}}

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue">Students</h4>
                    </div>
                </div>

                <div class="row">
                    <table class="data-table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th>Roll</th>
                            <th>Student Name</th>
                            <th>Result</th>
                            <th class="datatable-nosort sorting_asc">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input class="custom-control-input" type="checkbox" id="select-all"/> <label
                                            class="custom-control-label" for="select-all">Select All</label>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="body">
                        @if(empty($students))
                            <p>Data does not exist</p>
                        @else
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->roll }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->meritLists->first()->grade->name }}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="hidden" class="custom-control-input"
                                                   name="student[{{$student->id}}]" value="no">

                                            <input type="checkbox" class="custom-control-input"
                                                   name="student[{{$student->id}}]" value="yes"
                                                   id="{{$student->id}}" {{ ($student->meritLists->first()->grade->name == 'F')?"":"checked" }}>

                                            <label class="custom-control-label"
                                                   for="{{$student->id}}">Promote</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <button class="btn btn-success pull-right" type="submit" value="Add">Promote</button>
                    </div>
                </div>

            </div>

        </form>
    @endif

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

    <script src="/src/plugins/switchery/dist/switchery.js"></script>

    <script>
        $(function () {
            // Switchery
            // var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
            $('.switch-btn').each(function () {
                new Switchery($(this)[0], $(this).data());
            });

            var changeCheckbox = document.querySelector('#to_inactive');

            var $promote_to_select = $('#promote_to select');

            changeCheckbox.onchange = function () {
                if (changeCheckbox.checked) {
                    $promote_to_select.each(function () {
                        $(this).prop('disabled', true);
                    });
                } else {
                    $promote_to_select.each(function () {
                        $(this).prop('disabled', false);
                    });
                }
            };
        });

    </script>

    <script>
        $(function () {
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
                "paging": false,
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

    <script type="text/javascript">

        $(function ($) {
            $('#theclass').change(function () {
                $.get("{{ url('api/dropdown')}}",
                    {option: $(this).val()},
                    function (data) {
                        var subject = $('#subject');
                        subject.empty();

                        $.each(data, function (index, element) {
                            subject.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    });
            });
        });

        $(function () {
            $('input#select-all').change(function () {
                if (this.checked) {
                    $("input[type=checkbox]").prop('checked', true);
                } else {
                    $("input[type=checkbox]").prop('checked', false);
                }
            });
        });

    </script>
@endsection