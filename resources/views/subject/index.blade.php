@extends('layouts.app')
@section('styles')

    <style>

        #loading-indicator {

            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1000;
            background: white;

            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;
        }



    </style>


    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



@endsection
@section('content')

    <div id="loading-indicator" style="display: none;">

        <img src="/images/ajax-loader.gif" />

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="form-group pd-20 bg-white border-radius-4 box-shadow mb-30">
        <form>
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Select a Class :</label>
                        <select id="the_class_id" class="custom-select2 form-control"
                                style="width: 100%; height: 38px;">
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button id="btn-generate" name="btn-generate" class="btn btn-success">View</button>
        </form>
    </div>



    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">


        <div class="clearfix mb-20">
            <div class="pull-left">
                @if(! empty($forClass))
                    <h5 class="text-blue"> Class {{$forClass}}</h5>
                @endif
                <h5 class="text-blue">Subject Information </h5>

            </div>
        </div>


        <div class="row">
            <table id="mytable" class="data-table stripe hover nowrap">
                <thead>
                <tr>

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

                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->theClass->name}}</td>
                            <td>{{ $subject->group->name}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('subjects.show',$subject->id) }}">View
                                            Details</a>
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
                            url: "/subjects/" + id,
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

    <script>

        $("#btn-generate").click(function (e) {
            e.preventDefault();
            console.log(" Submitted ");
            _token = $("input[name='_token']").val();
            the_class_id = $('#the_class_id :selected').val();
            var dataTable = $('#mytable').DataTable();
            $("#mytable").DataTable().clear().draw();

            console.log(the_class_id);


            $.ajax({
                url: "/getSubjects",
                type: 'POST',
                data: {
                    _token: _token,
                    the_class_id: the_class_id,
                },

                success: function (data) {

                    $.each(data, function (index, element) {

                        if (element.is_active == 1) {
                            opening = '<p id=\"active\" class=\"badge badge-success\">';
                            activeStatus = "Active";
                        } else {
                            opening = '<p id=\"active\" class=\"badge badge-danger\">';
                            activeStatus = "Inactive";

                        }

                        dataTable.row.add([
                            element.name,
                            element.code,
                            element.the_class_id,
                            group_name(element.group_id),
                            '<div class="dropdown">\n' +
                            '                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"\n' +
                            '                                       data-toggle="dropdown">\n' +
                            '                                        <i class="fa fa-ellipsis-h"></i>\n' +
                            '                                    </a>\n' +
                            '                                    <div class="dropdown-menu dropdown-menu-right">\n' +
                            '                                        <a href="/subjects/' + element.id + '/edit" class="dropdown-item"><i\n' +
                            '                                                    class="fa fa-pencil"></i> Edit</a>\n' +
                            '                                        <a class="dropdown-item ts-delete" data-id="' + element.id + '" href=""><i\n' +
                            '                                                    class="fa fa-pencil"></i> Delete</a>\n' +
                            '                                    </div>\n' +
                            '                                </div>'
                        ]).draw(false);


                        function group_name(id) {
                            switch(id) {
                                case 1:
                                     return "Science";
                                    break;
                                case 2:
                                    return "Commerce";
                                    break;
                                case 3:
                                    return" Arts";
                                    break;
                                case 4:
                                    return "None";
                                    break;
                                default:
                                    return "None";
                            }
                        }

                    });
                }

            });

            $(document).ajaxSend(function(event, request, settings) {
                $('#loading-indicator').fadeIn();
            });


            $(document).ajaxComplete(function(event, request, settings) {
                $('#loading-indicator').fadeOut();
            });

        });


    </script>



@endsection