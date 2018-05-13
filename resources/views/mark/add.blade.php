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

<form action="" method="post">

    @csrf
    <!-- -->
    @method('PUT')
    <!-- -->

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue">Add Marks</h4>
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
                <input type="year" value="{{ $query['session'] }}" class="form-control" name="session" id="session" placeholder="1971" disabled>
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
                    <td>{{$subject->written_pass_marks}}</td>
                    @endif
                    <!-- -->
                    @if($subject->has_mcq)
                    <td>{{$subject->mcq_pass_marks}}</td>
                    @endif
                    <!-- -->
                    @if($subject->has_practical)
                    <td>{{$subject->practical_pass_marks}}</td>
                    @endif
                </tr>
            </tbody>
        </table>

    </div>

    <!-- Simple Datatable start -->
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue mb-10">Set the student marks and click
                    <span class="badge badge-primary">Submit</span>
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

                    @foreach($students as $student)

                    <tr id="{{$student->id}}" class="ts-student-row">
                        <td class="table-plus">{{$student->roll}}</td>
                        <td>{{$student->name}}</td>

                        @if($subject->has_written)
                        <td>
                            <input type="text" pattern="^\d{1,3}$" class="form-control" name="written[{{$student->id}}]" id="written" value="0" placeholder="Written Mark"
                                required>
                        </td>
                        @endif @if($subject->has_mcq)
                        <td>
                            <input type="text" pattern="^\d{1,3}$" class="form-control" name="mcq[{{$student->id}}]" id="mcq" value="0" placeholder="MCQ Mark"
                                required>
                        </td>
                        @endif @if($subject->has_practical)
                        <td>
                            <input type="text" pattern="^\d{1,3}$" class="form-control" name="practical[{{$student->id}}]" id="practical" value="0" placeholder="Practical Mark"
                                required>
                        </td>
                        @endif

                        <td id="total">0</td>
                        <td id="point">0</td>
                        <td id="grade">-</td>
                        <td>
                            <input type="checkbox" class="form-control" name="absent[{{$student->id}}]" id="absent" value="true">
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">Submit Marks</button>
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

        $('input#absent').on('change', function () {
            $parent = $(this).parent().parent();

            var checkbox_this = this;

            $parent.find('input[type=text]').each(function () {
                $(this).prop('disabled', checkbox_this.checked);
            });
        });

        $('.ts-student-row input').on('keyup', function () {
            $parent = $(this).parent().parent();

            $written = parseInt($parent.find('#written').val()) || 0;
            $mcq = parseInt($parent.find('#mcq').val()) || 0;
            $practical = parseInt($parent.find('#practical').val()) || 0;

            var total_mark = $written + $mcq + $practical;
            $parent.find('#total').text(total_mark);
            $parent.find('#point').text(getPoint(total_mark));
            $parent.find('#grade').text(getGrade(total_mark));

        });

    });

    function getPoint(val) {
        val = parseInt(val);
        if (val >= 0 && val <= 32) {
            return 0;
        } else if (val >= 33 && val <= 39) {
            return 1;
        } else if (val >= 40 && val <= 49) {
            return 2;
        } else if (val >= 50 && val <= 59) {
            return 3;
        } else if (val >= 60 && val <= 69) {
            return 3.5;
        } else if (val >= 70 && val <= 79) {
            return 4;
        } else if (val >= 80) {
            return 5;
        }
    }

    function getGrade(val) {
        val = parseInt(val);
        if (val >= 0 && val <= 32) {
            return "F";
        } else if (val >= 33 && val <= 39) {
            return "D";
        } else if (val >= 40 && val <= 49) {
            return "C";
        } else if (val >= 50 && val <= 59) {
            return "B";
        } else if (val >= 60 && val <= 69) {
            return "A-";
        } else if (val >= 70 && val <= 79) {
            return "A";
        } else if (val >= 80) {
            return "A+";
        }
    }
</script>


@endsection