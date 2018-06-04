@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Assign Optional Subjects</h5>

            </div>
        </div>
        {{--<div class="col-md-4 col-sm-12">--}}
        {{--<div class="form-group">--}}
        {{--<label>multiple Select</label>--}}
        {{--<form id="multi" action="/subjects/optional/edit/list" method="post">--}}
        {{--@csrf--}}
        {{--<select required="required" class="form-control" id="div_class" name="class">--}}
        {{--<option value="">Select Class</option>--}}
        {{--@foreach($classes as $class)--}}
        {{--<option value="{{$class->id}}">{{$class->name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--<select required="required" class="form-control" id="div_group" name="group">--}}
        {{--<option value="">Select Group</option>--}}
        {{--@foreach($groups as $group)--}}
        {{--<option value="{{$group->id}}">{{$group->name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--<select required="required" class="form-control" id="div_section" name="section">--}}
        {{--<option value="">Select Section</option>--}}
        {{--@foreach($sections as $section)--}}
        {{--<option value="{{$section->id}}">{{$section->name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--<input type="submit" id="submit" class="btn btn-success" value="Submit">--}}
        {{--</form>--}}
        {{--</div>--}}
        {{--</div>--}}
        <form method="post" action="/subjects/optional/update">
            @csrf
            <div class="row">
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Group</th>
                        <th class="datatable-nosort">Select Optional Subject</th>
                    </tr>
                    </thead>
                    <tbody id="body">
                    @if(empty($students))
                    @else
                        @foreach($students as $student)

                            <tr>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->theClass->name}}</td>
                                <td>{{$student->section->name}}</td>
                                <td>{{$student->group->name}}</td>
                                <td>
                                    <select class="custom-select form-control" id="optional_id" name="{{$student->id}}">
                                        @if(!isset($optionals[$student->id]))
                                            <option value="">Select Optional Subject</option>
                                        @endif
                                        @foreach($subjects as $subject)
                                            @if(isset($optionals[$student->id]))
                                                <option value="{{$subject->id}}" {{$optionals[$student->id] == $subject->id? 'selected':''}}>{{$subject->name}} </option>
                                            @else
                                                <option value="{{$subject->id}}">{{$subject->name}} </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
            {{--@if(count($optionalSubjects) != 0)--}}
                <input type="submit" value="Update" class="btn btn-outline-success"/>
            {{--@endif--}}
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


{{--@include('layouts.header')--}}



