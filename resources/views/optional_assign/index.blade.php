@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Students Information</h5>

            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label>multiple Select</label>
                <form id="multi" action="/students/optional-subjects/get" method="post">
                    @csrf
                    <select required="required" class="form-control" id="div_class" name="class">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                    <select required="required" class="form-control" id="div_group" name="group">
                        <option value="">Select Group</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                    <select required="required" class="form-control" id="div_section" name="section">
                        <option value="">Select Section</option>
                        @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" id="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Roll</th>
                    <th>Group</th>
                    <th>Photo</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
                <tbody id="body">
                @if(empty($students))
                    <p>Data does not exist</p>
                @else
                    @foreach($students as $student)
                        <tr>
                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->theClass->name}}</td>
                            <td>{{$student->section->name}}</td>
                            <td>{{$student->roll}}</td>
                            <td>{{$student->group->name}}</td>
                            <td><img src="/images/{{$student->user_id}}/{{$student->photo}}" class="img-responsive"
                                     alt="Student Photo"></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/students/{{$student->id}}/edit"><i
                                                    class="fa fa-pencil"></i> Edit</a>

                                        <a class="dropdown-item ts-delete" href="" data-id="{{$student->id}}"><i
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
        // get first dropdown and bind change event handler
        // $('#div_class').change(function () {
        //     // get optios of second dropdown and cache it
        //     var $options = $('#div_group')
        //     // update the dropdown value if necessary
        //         .val('')
        //         // get options
        //         .find('option')
        //         // show all of the initially
        //         .show();
        //     // check current value is not 0
        //     if (this.value != '0')
        //         $options
        //         // filter out options which is not corresponds to the first option
        //             .not('[data-val="' + this.value + '"],[data-val=""]')
        //             // hide them
        //             .hide();
        //
        // });
        //
        // $('#div_group').change(function () {
        //     // get optios of second dropdown and cache it
        //     var $options = $('#div_section')
        //     // update the dropdown value if necessary
        //         .val('')
        //         // get options
        //         .find('option')
        //         // show all of the initially
        //         .show();
        //     // check current value is not 0
        //     if (this.value != '0')
        //         $options
        //         // filter out options which is not corresponds to the first option
        //             .not('[data-val="' + this.value + '"],[data-val=""]')
        //             // hide them
        //             .hide();
        //
        // });
        // $("$body").hide();
        // $('#multi').submit(function(e){
        //     $.ajaxSetup({
        //         header:$('meta[name="_token"]').attr('content')
        //     });
        //     e.preventDefault(e);
        //
        //     $.ajax({
        //
        //         type:"POST",
        //         url:'/students/optional-subjects/get',
        //         data:$(this).serialize(),
        //         dataType: 'json',
        //         success: function(data){
        //             console.log(data);
        //         },
        //         error: function(data){
        //
        //         }
        //     })
        // });

    </script>
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
                            url: "/students/" + id,
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




