@extends('layouts.app')
@section('styles')

    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/dist/switchery.css">
    <!-- bootstrap-tagsinput css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <!-- bootstrap-touchspin css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css">



    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@endsection
@section('content')










    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Exam Terms Information</h5>

            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th>Serial</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Section</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
                <tbody id="body">
                @if(empty($classAssigns))
                    <p>Data does not exist</p>
                @else
                    @foreach($classAssigns as $classAssign)
                        <tr>
                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{$classAssign->subject->name}}</td>
                            <td>{{$classAssign->class->name}}</td>
                            <td>{{$classAssign->teacher->name}}</td>
                            <td>{{$classAssign->section->name}}</td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/classAssigns/{{$classAssign->id}}/edit"><i
                                                    class="fa fa-pencil"></i> Edit</a>
                                        {{--<form action="{{route('exam-terms.destroy',$examTerm->id)}}" method="post">--}}
                                        {{--{{csrf_field()}}--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button style="cursor: pointer;" type="submit" class="dropdown-item" ><i class="fa fa-trash"></i> Delete</button>--}}
                                        {{--</form>--}}
                                        <a class="dropdown-item ts-delete" href="" data-id="{{$classAssign->id}}"><i
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
    <!-------------------------------------------------------------->




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
                .then((willDelete) = > {
                if(willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "/classAssigns/" + id,
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: "DELETE"
                        },
                        success: function (data) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            }).then(() = > {
                                location.reload();
                        })
                            ;
                        }
                    });
                } else {
                    swal("Your imaginary file is safe!"
        )
            ;
        }
        })
            ;
        });
    </script>


    <script src="src/plugins/switchery/dist/switchery.js"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="src/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
    <!-- bootstrap-touchspin js -->
    <script src="src/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>
    <script>
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
        $('.switch-btn').each(function () {
            new Switchery($(this)[0], $(this).data());
        });

        // Bootstrap Touchspin
        $("input[name='demo_vertical2']").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'fa fa-plus',
            verticaldownclass: 'fa fa-minus'
        });
        $("input[name='demo3']").TouchSpin();
        $("input[name='demo1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='demo2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='demo3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='demo5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
    </script>




@endsection


{{--@include('layouts.header')--}}




