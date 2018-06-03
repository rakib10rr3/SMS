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

    <form action="{{route('marks.update')}}" method="post">

    @csrf
    <!-- -->
        @method('patch')

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue">Update Marks</h4>
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
                    <label for="subject">Subject</label>
                    <select class="form-control custom-select" name="subject" id="subject" disabled>

                        <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>

                    </select>
                </div>
            </div>

            <div class="row">
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
                    <h4 class="text-blue">Mark Distribution</h4>
                </div>
            </div>

            <!--
    Marks:
                Written     MCQ     Practical   SBA     Full Marks
                100         25      10          15      5
    Pass Marks:
                35          25      10          15      5

                -->

            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Marks</th>

                    @if($subject->has_written)
                        <th scope="col">Written</th>
                    @endif
                <!-- -->
                    @if($subject->has_mcq)
                        <th scope="col">MCQ</th>
                    @endif
                <!-- -->
                    @if($subject->has_practical)
                        <th scope="col">Practical</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Full Marks</th>
                    <td>{{$subject->full_marks}}</td>

                    @if($subject->has_written)
                        <td>{{$subject->written_marks}}</td>
                    @endif
                <!-- -->
                    @if($subject->has_mcq)
                        <td>{{$subject->mcq_marks}}</td>
                    @endif
                <!-- -->
                    @if($subject->has_practical)
                        <td>{{$subject->practical_marks}}</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">Pass Marks</th>
                    <td>{{$subject->pass_marks}}</td>

                    @if($subject->has_written)
                        <td id="pass_written">{{$subject->written_pass_marks}}</td>
                    @endif
                <!-- -->
                    @if($subject->has_mcq)
                        <td id="pass_mcq">{{$subject->mcq_pass_marks}}</td>
                    @endif
                <!-- -->
                    @if($subject->has_practical)
                        <td id="pass_practical">{{$subject->practical_pass_marks}}</td>
                    @endif
                </tr>
                </tbody>
            </table>

        </div>


        <!-- Simple Datatable start -->
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h5 class="text-blue mb-10">Update the student marks and click
                        <span class="badge badge-primary">Update</span>
                    </h5>
                    <div class="alert alert-danger" role="alert">
                        NOTE: If absent is checked then marks will not be saved.
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus">Roll</th>
                        <th>Name</th>

                        @if($subject->has_written)
                            <th class="datatable-nosort">Written</th>
                        @endif
                    <!-- -->
                        @if($subject->has_mcq)
                            <th class="datatable-nosort">MCQ</th>
                        @endif
                    <!-- -->
                        @if($subject->has_practical)
                            <th class="datatable-nosort">Practical</th>
                        @endif

                        <th>Total</th>
                        <th>Grade Point</th>
                        <th>Grade</th>
                        <th>Is Absent?</th>
                        {{--
                        <th class="datatable-nosort">Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($marks as $mark)

                        <tr id="{{$mark->student->id}}" class="ts-student-row">
                            <td class="table-plus">{{$mark->student->roll}}</td>
                            <td>{{$mark->student->name}}</td>

                            @if($subject->has_written)
                                <td>
                                    <input type="text" pattern="^\d{1,3}$" class="form-control"
                                           name="written[{{$mark->student->id}}]" id="written"
                                           value="{{empty($mark->written) ? "0" : $mark->written }}"
                                           placeholder="Written Mark" required>
                                </td>
                            @endif @if($subject->has_mcq)
                                <td>
                                    <input type="text" pattern="^\d{1,3}$" class="form-control"
                                           name="mcq[{{$mark->student->id}}]" id="mcq"
                                           value="{{empty($mark->mcq) ? "0" : $mark->mcq }}"
                                           placeholder="MCQ Mark" required>
                                </td>
                            @endif @if($subject->has_practical)
                                <td>
                                    <input type="text" pattern="^\d{1,3}$" class="form-control"
                                           name="practical[{{$mark->student->id}}]" id="practical"
                                           value="{{empty($mark->practical) ? "0" : $mark->practical }}"
                                           placeholder="Practical Mark" required>
                                </td>
                            @endif

                            <td id="total">
                            @if($mark->absent)
                                <!-- -->
                                {{ "0" }}
                                <!-- -->
                            @else
                                <!-- -->
                                {{ $mark->total_marks }}
                                <!-- -->
                                @endif
                            </td>
                            <td id="point">
                            @if($mark->absent)
                                <!-- -->
                                {{ "0" }}
                                <!-- -->
                            @else
                                <!-- -->
                                {{ $mark->point }}
                                <!-- -->
                                @endif
                            </td>
                            <td id="grade">
                            @if($mark->absent)
                                <!-- -->
                                {{ "F" }}
                                <!-- -->
                            @else
                                <!-- -->
                                {{ $mark->grade->name }}
                                <!-- -->
                                @endif
                            </td>
                            <td>
                                <input type="checkbox" class="form-control" name="absent[{{$mark->student->id}}]"
                                       id="absent" value="true" @if($mark->absent) checked @endif>

                                <input type="hidden" name="mark_id[{{$mark->student->id}}]" value="{{$mark->id}}">
                            </td>

                        </tr>



                    @endforeach


                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
            </div>
        </div>
        <!-- Simple Datatable End -->

    </form>

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

    <script>
        $(function () {

            $('.ts-student-row input[type=text]').focus(function () {

                $(this).select();

            });

            $('input#absent').each(function () {

                $parent = $(this).parent().parent();

                var checkbox_this = this;

                $parent.find('input[type=text]').each(function () {
                    $(this).prop('disabled', checkbox_this.checked);
                });

            });

            $('input#absent').on('change', function () {
                $parent = $(this).parent().parent();

                var checkbox_this = this;

                $parent.find('input[type=text]').each(function () {
                    $(this).prop('disabled', checkbox_this.checked);
                    $(this).val(0);
                });

                $parent.find('#total').text("0");
                $parent.find('#point').text("0.00");
                $parent.find('#grade').text("F");
            });

            var pass_written = parseFloat($('#pass_written').text()) || 0;
            var pass_mcq = parseFloat($('#pass_mcq').text()) || 0;
            var pass_practical = parseFloat($('#pass_practical').text()) || 0;


            $('.ts-student-row input').on('keyup', function () {
                $parent = $(this).parent().parent();

                $written = parseFloat($parent.find('#written').val()) || 0;
                $mcq = parseFloat($parent.find('#mcq').val()) || 0;
                $practical = parseFloat($parent.find('#practical').val()) || 0;

                var is_fail = false;

                if ($written < pass_written) {
                    is_fail = true;
                }
                if ($mcq < pass_mcq) {
                    is_fail = true;
                }
                if ($practical < pass_practical) {
                    is_fail = true;
                }

                var total_mark = $written + $mcq + $practical;
                $parent.find('#total').text(total_mark);
                if (is_fail) {
                    $parent.find('#point').text("0.00");
                    $parent.find('#grade').text("F");
                } else {
                    $parent.find('#point').text(getPoint(total_mark));
                    $parent.find('#grade').text(getGrade(total_mark));
                }

            });

            $('.ts-student-row input#absent').each(function () {
                $parent = $(this).parent().parent();

                $written = parseFloat($parent.find('#written').val()) || 0;
                $mcq = parseFloat($parent.find('#mcq').val()) || 0;
                $practical = parseFloat($parent.find('#practical').val()) || 0;

                var is_fail = false;

                if ($written < pass_written) {
                    is_fail = true;
                }
                if ($mcq < pass_mcq) {
                    is_fail = true;
                }
                if ($practical < pass_practical) {
                    is_fail = true;
                }

                var total_mark = $written + $mcq + $practical;
                $parent.find('#total').text(total_mark);
                if (is_fail) {
                    $parent.find('#point').text("0.00");
                    $parent.find('#grade').text("F");
                } else {
                    $parent.find('#point').text(getPoint(total_mark));
                    $parent.find('#grade').text(getGrade(total_mark));
                }

            });

        });

        var grade_value = [
            @foreach($grades as $value)
                {{$value['min_value']}},
            @endforeach
        ];

        var grade_point = [
            @foreach($grades as $value)
                "{{number_format($value['min_point'], 2)}}",
            @endforeach
        ];

        var grade_name = [
            @foreach($grades as $value)
                "{{$value['name']}}",
            @endforeach
        ];

        function getPoint(val) {
            val = parseFloat(val);

            var length = grade_value.length;

            for (var i = 0; i < length; i++) {

                if (val >= grade_value[i]) {

                    return grade_point[i];

                }
            }

        }

        function getGrade(val) {
            val = parseFloat(val);

            var length = grade_value.length;

            for (var i = 0; i < length; i++) {

                if (val >= grade_value[i]) {

                    return grade_name[i];

                }
            }
        }
    </script>


@endsection