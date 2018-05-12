@extends('layouts.app') @section('styles')

<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css"> @endsection @section('content')


<form action="" method="post">

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue">Add Marks</h4>
                <p class="mb-30 font-14">Select below fields and click Go</p>
            </div>
        </div>

        @csrf @if(isset($query)) @foreach($query as $key => $value)
        <input type="hidden" name="{{$key}}" value="{{ $value }}"> @endforeach @endif

        <div class="form-group">
            <label for="theclass">Class</label>
            <select class="form-control custom-select" name="theclass" id="theclass" {{ (isset($query))? 'disabled': '' }}>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ (isset($query))? ( ($query[ 'theclass']==$class->id)?'selected':'' ) :'' }}>{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="section">Section</label>
            <select class="form-control custom-select" name="section" id="section" {{ (isset($query))? 'disabled': '' }}>
                @foreach($sections as $section)
                <option value="{{ $section->id }}" {{ (isset($query))? ( ($query[ 'section']==$section->id)?'selected':'' ) :'' }}>{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="shift">Shift</label>
            <select class="form-control custom-select" name="shift" id="shift" {{ (isset($query))? 'disabled': '' }}>
                @foreach($shifts as $shift)
                <option value="{{ $shift->id }}" {{ (isset($query))? ( ($query[ 'shift']==$shift->id)?'selected':'' ) :'' }}>{{ $shift->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="session">Session Year</label>
            <input type="year" value="{{ (isset($query))?$query['session']: \Carbon\Carbon::now()->year }}" class="form-control" name="session"
                id="session" aria-describedby="helpId" placeholder="1971" {{ (isset($query))? 'disabled': '' }}>
        </div>


        <div class="form-group">
            <label for="subject">Subject</label>
            <select class="form-control custom-select" name="subject" id="subject" {{ (isset($query))? 'disabled': '' }}>
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ (isset($query))? ( ($query[ 'subject']==$subject->id)?'selected':'' ) :'' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exam_term">Exam Term</label>
            <select class="form-control custom-select" name="exam_term" id="exam_term" {{ (isset($query))? 'disabled': '' }}>
                @foreach($exam_terms as $exam_term)
                <option value="{{ $exam_term->id }}" {{ (isset($query))? ( ($query[ 'exam_term']==$exam_term->id)?'selected':'' ) :'' }}>{{ $exam_term->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Go</button>


        {{-- student list written mcq practical class attendance total marks grade point absent --}}


    </div>
    <!-- Simple Datatable start -->
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                {{--
                <h5 class="text-blue"></h5> --}}
                <p class="font-14">Set the student marks and click Submit.</p>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Written</th>
                        <th>MCQ</th>
                        <th>Practical</th>
                        <th>Class Attendance</th>
                        <th>Grade Point</th>
                        <th>Grade</th>
                        {{-- <th class="datatable-nosort">Action</th> --}}
                    </tr>
                </thead>
                <tbody>

                    <tr>
                            <td>Name</td>
                            <td>Roll</td>
                            <td>Name</td>
                            <td>Written</td>
                            <td>MCQ</td>
                            <td>Practical</td>
                            <td>Class Attendance</td>
                            <td>Grade Point</td>
                            <td>Grade</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->


    <button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection @section('scripts')

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
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
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
    // $('#session').val((new Date()).getFullYear());
</script>

<script>
    $(document).ready(function () {

        $('#theclass').change(function () {

            $url = "/api/subjects/" + $(this).val();

            $.get($url, {},
                function (data) {
                    var subject = $('#subject');
                    subject.empty();

                    $.each(data, function (index, element) {
                        subject.append("<option value='" + element.id + "'>" + element.name +
                            "</option>");
                    });
                });
        });
    });
</script>


@endsection