@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <form action="../getSubjects" method="POST">
            @csrf
            <strong>Select Class to show:</strong>
            <select name="class_id" id="class_id">
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Subject Information</h5>

            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Class</th>
                    <th>Group</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(empty($subjects))
                    <p>Data does not exist</p>
                @else

                    @foreach($subjects as $subject)
                        <tr>

                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->theClass->name}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('subjects.show',$subject->id) }}">View Details</a>
                                        <a class="dropdown-item" href="{{ route('subjects.edit',$subject->id) }}"><i
                                                    class="fa fa-pencil"></i> Edit</a>
                                        {{--<form action="{{route('exam-terms.destroy',$examTerm->id)}}" method="post">--}}
                                        {{--{{csrf_field()}}--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button style="cursor: pointer;" type="submit" class="dropdown-item" ><i class="fa fa-trash"></i> Delete</button>--}}
                                        {{--</form>--}}
                                        <a class="dropdown-item ts-delete" href="" data-id="{{$subject->id}}"><i
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

    {{--<table id="show_subjects" class="table table-bordered">--}}
        {{--<tr>--}}
            {{--<th>No</th>--}}
            {{--<th>Subject Name</th>--}}
            {{--<th>Subject Code</th>--}}
            {{--<th>Class</th>--}}
            {{--<th>Action</th>--}}
        {{--</tr>--}}
        {{--@foreach ($subjects as $subject)--}}
            {{--<tr>--}}
                {{--<td>{{ $loop->iteration }}</td>--}}
                {{--<td>{{ $subject->name }}</td>--}}
                {{--<td>{{ $subject->code }}</td>--}}
                {{--<td>{{ $subject->class->name }}</td>--}}
                {{--<td>--}}
                    {{--<a class="btn btn-info" href="{{ route('subjects.show',$subject->id) }}">View Details</a>--}}
                    {{--<a class="btn btn-info" href="{{ route('subjects.edit',$subject->id) }}">Edit</a>--}}
                    {{--<form onsubmit="return confirm('Do you want to delete?')" action="{{ route('subjects.destroy',$subject->id) }}" method="POST">--}}
                        {{--@csrf--}}
                        {{--@method('DELETE')--}}
                        {{--<button type="submit" class="btn btn-danger">Delete</button>--}}
                    {{--</form>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}

    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('#class_id').change(function () {--}}
                {{--var id = $(this).val();--}}
                {{--$.ajax({--}}
                    {{--url:"/getSubjects/",--}}
                    {{--method: "GET",--}}
                    {{--data:{id:id},--}}
                    {{--success: function (data) {--}}
                        {{--$('#show_subjects').html(data.html);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
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