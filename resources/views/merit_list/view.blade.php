@extends('layouts.app')
<!-- -->
@section('styles')
    <!-- -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">

    <!-- -->
@endsection
<!-- -->
@section('content')
    <!-- -->


    <form action="{{route('meritList.update')}}" method="post">
    @csrf
    @method('PUT')
    <!-- -->

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue">Marks</h4>
                </div>
            </div>

            <!-- -->
            @foreach($query as $key => $value)

                <input type="hidden" name="{{$key}}" value="{{ $value }}">
                <!-- -->
            @endforeach

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="theclass">Class</label>
                    <select class="form-control custom-select" name="theclass" id="theclass" disabled>
                        <option value="{{ $class->id }}" selected>{{ $class->name }}</option>

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="section">Section</label>
                    <select class="form-control custom-select" name="section" id="section" disabled>

                        <option value="{{ $section->id }}" selected>{{ $section->name }}</option>

                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="shift">Shift</label>
                    <select class="form-control custom-select" name="shift" id="shift" disabled>

                        <option value="{{ $shift->id }}" selected>{{ $shift->name }}</option>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="shift">Group</label>
                    <select class="form-control custom-select" name="group" id="group" disabled>

                        <option value="{{ $group->id }}" selected>{{ $group->name }}</option>

                    </select>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="session">Session Year</label>
                    <input type="year" value="{{ $query['session'] }}" class="form-control" name="session" id="session"
                           placeholder="1971" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label for="exam_term">Exam Term</label>
                    <select class="form-control custom-select" name="exam_term" id="exam_term" disabled>

                        <option value="{{ $exam_term->id }}" selected>{{ $exam_term->name }}</option>

                    </select>
                </div>
            </div>


        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue">Grade Distribution</h4>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Min Point</th>
                    <th scope="col">Max Point</th>
                    <th scope="col">Grade</th>
                </tr>
                </thead>
                <tbody>

                @foreach($grades as $grade)

                    <tr>
                        <td>{{number_format($grade->min_point, 2)}}</td>
                        <td>{{number_format($grade->max_point, 2)}}</td>
                        <td>{{$grade->name}}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>


        <!-- Simple Datatable start -->
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue mb-10">Student marks</h4>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary pull-right">Re-calculate Marks</button>
                </div>
            </div>
            <div class="row">
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus">Roll</th>
                        <th>Name</th>

                        <th>Total</th>
                        <th>Grade Point</th>
                        <th>Grade</th>
                        {{--
                        <th class="datatable-nosort">Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($merit_lists as $merit_list)

                        <tr id="{{$merit_list->student->id}}" class="ts-student-row">
                            <td class="table-plus">{{$merit_list->student->roll}}</td>
                            <td>{{$merit_list->student->name}}</td>

                            <td id="total">
                                {{ $merit_list->total_marks }}
                            </td>
                            <td id="point">
                                {{ number_format($merit_list->point, 2) }}
                            </td>
                            <td id="grade">
                                {{ $merit_list->grade->name }}
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Re-calculate Marks</button>
                </div>
            </div>
        </div>
        <!-- Simple Datatable End -->


    </form>
    <!-- -->
@endsection
<!-- -->
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
                "language": {
                    "info": "Total _TOTAL_ students",
                    searchPlaceholder: "Search"
                },
                paging: false
            });
            $('.data-table-export').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
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
                } else {
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