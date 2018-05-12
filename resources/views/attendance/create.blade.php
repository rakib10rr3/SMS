@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">
    {{--<link rel="stylesheet" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">--}}
@endsection
@section('content')
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <h5 class="text-blue">Attendance</h5>

        </div>
        <form method="post" action="{{ route('attendance.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <strong>Class:</strong>
                    @foreach($class_name as $class_name)
                        <p><input hidden name="the_class_id" value="{{ $class_name->id }}">{{ $class_name->name }}</p>
                    @endforeach
                </div>
                <div class="col-md-2">
                    <strong>Shift:</strong>
                    @foreach($shift_name as $shift_name)
                        <p><input hidden name="shift_id" value="{{ $shift_name->id }}">{{ $shift_name->name }}</p>
                    @endforeach
                </div>
                <div class="col-md-2">
                    <strong>Section:</strong>
                    @foreach($section_name as $section_name)
                        <p><input hidden name="section_id" value="{{ $section_name->id }}">{{ $section_name->name }}</p>
                    @endforeach
                </div>
                <div class="col-md-2">
                    <strong>Subject:</strong>
                    @foreach($subject_name as $subject_name)
                        <p><input hidden name="subject_id" value="{{ $subject_name->id }}">{{ $subject_name->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Date :</label>
                    <input type="text" class="form-control date-picker" placeholder="Select Date" id="attendance_date" name="date">
                </div>
            </div>
            <div class="row">
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Student Name</th>
                        <th>Is present?</th>
                    </tr>
                    </thead>
                    <tbody id="body">
                    @if(empty($students))
                        <p>Data does not exist</p>
                    @else
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                <td>
                                    {{--<input type="checkbox" name="{{$student->id}}" id="attend{{$student->id}}">--}}
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" name="{{$student->id}}" id="{{$student->id}}">
                                        <label class="custom-control-label" for="{{$student->id}}">Present</label>
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
                    <button class="btn btn-success" type="submit" value="Add">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')


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
        $(document).on('click', '.ts-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
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
                            url: "/teachers/" + id,
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: "DELETE"
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