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
        <div>
            <select required="required" class="form-control" id="div_years" name="div_years">
                <option value="">Select</option>
                <option value="0">All Years</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
            <select required="required" class="form-control" id="div_sections" name="div_sections">
                <option value="">Select</option>
                <option value="20" data-val="1">1 Section - A</option>
                <option value="21" data-val="1">1 Section - B</option>
                <option value="22" data-val="1">1 Section - C</option>
                <option value="24" data-val="2">2 Section - A</option>
                <option value="25" data-val="2">2 Section - B</option>
                <option value="28" data-val="3">3 Section - A</option>
                <option value="32" data-val="4">4 Section - A</option>
                <option value="33" data-val="4">4 Section - B</option>
            </select>
            <select required="required" class="form-control" id="div_cities" name="div_cities">
                <option value="">Select</option>
                <option value="11" data-val="20">ctg</option>
                <option value="12" data-val="20">cox</option>
                <option value="13" data-val="20">feni</option>
                <option value="14" data-val="22">bbb</option>
                <option value="15" data-val="22">bb</option>
                <option value="16" data-val="25">t</option>
                <option value="17" data-val="24">jjj</option>
                <option value="18" data-val="24">jj</option>
            </select>
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
                                        {{--<form action="{{route('exam-terms.destroy',$examTerm->id)}}" method="post">--}}
                                        {{--{{csrf_field()}}--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button style="cursor: pointer;" type="submit" class="dropdown-item" ><i class="fa fa-trash"></i> Delete</button>--}}
                                        {{--</form>--}}
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
        $('#div_years').change(function () {
            // get optios of second dropdown and cache it
            var $options = $('#div_sections')
            // update the dropdown value if necessary
                .val('')
                // get options
                .find('option')
                // show all of the initially
                .show();
            // check current value is not 0
            if (this.value != '0')
                $options
                // filter out options which is not corresponds to the first option
                    .not('[data-val="' + this.value + '"],[data-val=""]')
                    // hide them
                    .hide();

        });

        $('#div_sections').change(function () {
            // get optios of second dropdown and cache it
            var $options = $('#div_cities')
            // update the dropdown value if necessary
                .val('')
                // get options
                .find('option')
                // show all of the initially
                .show();
            // check current value is not 0
            if (this.value != '0')
                $options
                // filter out options which is not corresponds to the first option
                    .not('[data-val="' + this.value + '"],[data-val=""]')
                    // hide them
                    .hide();

        });

        /*
        var $secondOptions = $('#div_cities').val('').find('option').show();
            if ($options.equals('0'))
                $secondOptions
                // filter out options which is not corresponds to the first option
                    .not('[data-val="' + this.value + '"],[data-val=""]')
                    // hide them
                    .hide();
         */


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




