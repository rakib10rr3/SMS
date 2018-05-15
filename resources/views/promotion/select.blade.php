@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <div align="center">
                <h4 class="text-danger">Promotion</h4>
            </div>
        </div>
    </div>

    @if($come==1)
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue">Promotion From</h4>
                </div>
            </div>
            <form method="post" action="{{ route('promotion.view') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-12 col-md-2 col-form-label">Shift:</label>
                            <select class="custom-select2 form-control" id="shift_id" name="shift_id">
                                <option value="">Select Shift</option>
                                @foreach($shifts as $shift)
                                    <option value="{{$shift->id}}">{{$shift->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-12 col-md-2 col-form-label">Section:</label>
                            <select class="custom-select2 form-control" id="section_id" name="section_id">
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label class="col-sm-12 col-md-2 col-form-label">Group:</label>
                            <select class="custom-select2 form-control" id="group_id" name="group_id">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-12 col-md-2 col-form-label"></label>
                    <div class="col-sm-12 col-md-10">
                        <button class="btn btn-success" type="submit" value="Add">Select</button>
                    </div>
                </div>
            </form>

        </div>
    @else
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue">Promotion From</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12 col-md-2 col-form-label">Shift:</label>
                        <select class="custom-select2 form-control" id="shift_id" name="shift_id" disabled>
                                <option value="{{$shift->id}}">{{$shift->name}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12 col-md-2 col-form-label">Section:</label>
                        <select class="custom-select2 form-control" id="section_id" name="section_id" disabled>
                                <option value="{{$section->id}}">{{$section->name}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group ">
                        <label class="col-sm-12 col-md-2 col-form-label">Group:</label>
                        <select class="custom-select2 form-control" id="group_id" name="group_id" disabled>
                                <option value="{{$group->id}}">{{$group->name}}</option>
                        </select>
                    </div>
                </div>
            </div>


            <form method="post" action="{{ route('promotion.update') }}">
                @csrf
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue">Promotion To</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-12 col-md-2 col-form-label">Shift:</label>
                            <select class="custom-select2 form-control" id="shift_id" name="shift_id">
                                <option value="">Select Shift</option>
                                @foreach($shifts as $shift)
                                    <option value="{{$shift->id}}">{{$shift->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-12 col-md-2 col-form-label">Section:</label>
                            <select class="custom-select2 form-control" id="section_id" name="section_id">
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label class="col-sm-12 col-md-2 col-form-label">Group:</label>
                            <select class="custom-select2 form-control" id="group_id" name="group_id">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="data-table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Student Name</th>
                            <th>Roll</th>
                            <th>Result</th>
                            <th class="datatable-nosort sorting_asc">
                                <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" id="select-all"/> <label class="custom-control-label" for="select-all">Select All</label>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->roll }}</td>
                                    <td>Dummy</td>
                                    <td>
                                        {{--<input type="checkbox" name="{{$student->id}}" id="attend{{$student->id}}">--}}
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="student[{{$student->id}}]" id="{{$student->id}}">
                                            <label class="custom-control-label" for="{{$student->id}}">Promote</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <label class="col-sm-12 col-md-2 col-form-label"></label>
                    <div class="col-sm-12 col-md-10">
                        <button class="btn btn-success" type="submit" value="Add">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    @endif

@endsection
@section('scripts')

    <script src="{{asset('/src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('/src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('/src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>
    <!-- buttons for Export datatable -->
    <script src="/src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.print.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.html5.js"></script>
    <script src="/src/plugins/datatables/media/js/button/buttons.flash.js"></script>
    <script src="/src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
    <script src="/src/plugins/datatables/media/js/button/vfs_fonts.js"></script>


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

    <script type="text/javascript">

        $(document).ready(function ($) {
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
                if(this.checked)
                {
                    $("input[type=checkbox]").prop('checked', true);
                } else {
                    $("input[type=checkbox]").prop('checked', false);
                }
            });
        });


    </script>
@endsection