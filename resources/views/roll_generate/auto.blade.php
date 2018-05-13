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
                <h5 class="text-blue">Generate Auto Roll</h5>

            </div>
        </div>
        <div class="col-md-4 col-sm-12">

        </div>

        <div class="form-group">
                    <form id="multi" action="{{route('autoRollList')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Class:</label>
                                    <select name="the_class_id" class="custom-select form-control">
                                        @foreach ($classes as $class)
                                            <option name="class"
                                                    value="{{ $class->id }}" {{$class->name != "One" ? 'disabled':''}}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Section:</label>
                                    <select name="section_id" class="custom-select form-control">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                    name="section">
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Shift:</label>
                                    <select name="shift_id" class="custom-select form-control">
                                        @foreach ($shifts as $shift)
                                            <option value="{{ $shift->id }}"
                                                      name="shift">
                                                {{ $shift->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--<div class="col">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>Group:</label>--}}
                            {{--<select name="group_id" class="custom-select form-control">--}}
                            {{--@foreach ($groups as $group)--}}
                            {{--<option value="{{ $group->id }}">--}}
                            {{--{{ $group->name }}--}}
                            {{--</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                        </div>

                        <input type="submit" id="submit" class="btn btn-success" value="Generate">
                    </form>
        </div>
        {{--@endif--}}
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h5 class="text-blue">Students List</h5>
                </div>
            </div>
            <div class="row">
                <table class="stripe hover multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Local Guardian's Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(empty($students))
                    @else
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->father_name}}</td>
                                <td>{{$student->mother_name}}</td>
                                <td>{{$student->local_guardian_name}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script src="{{asset('src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{asset('src/plugins/datatables/media/js/button/dataTables.buttons.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.print.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.html5.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.flash.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/pdfmake.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/vfs_fonts.js')}}"></script>




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








