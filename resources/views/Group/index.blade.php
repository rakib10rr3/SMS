@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')



    @if($success)

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>  Successfully saved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="clearfix mb-20">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="post" action="/groups">

                {{csrf_field()}}

                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Group Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" placeholder="Group Name" id="name"
                               name="name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-color-input" class="col-2 col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </div>


            </form>

        </div>

    </div>



    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="mytable">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h5 class="text-blue">Groups Information</h5>

            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th>Serial</th>
                    <th>Group Name</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(empty($groups))
                    <p>Data does not exist</p>
                @else
                    @foreach($groups as $group)
                        <tr>
                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{$group->name}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="edit-modal dropdown-item" data-toggle="modal"
                                           data-target="#Medium-modal" data-id="{{$group->id}}"
                                           data-content="{{$group->name}}">
                                            <i class="fa fa-pencil"></i>Edit</a>

                                        <a class="dropdown-item ts-delete" href="" data-id="{{$group->id}}"><i
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


        <!-- Medium modal -->
        <div class="col-md-4 col-sm-12">
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">


                <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Edit</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="updategroup">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group">
                                        <label for="group_name">Group name:</label>
                                        <input type="text" name="group_name" class="form-control" id="group_name"
                                               value="">
                                    </div>
                                    <input type="submit" id="addGroup" class="btn btn-success pull-right">
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
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
                            url: "/groups/" + id,
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



    <!-- Needed For Editing a group-->
    <script type="text/javascript">
        // Edit a Group
        $(document).on('click', '.edit-modal', function () {
            message = $(this).data('content');
            $('#content_edit').val(message);
            console.log(message);
            id = $(this).data('id');
            console.log(id);
            $('#Medium-modal').modal('show');
            $('#group_name').val(message);

            $("#updategroup").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/groups/" + id,
                    data: {
                        id: id,
                        name: $('#group_name').val(),
                        _token: '{{csrf_token()}}',
                        _method: 'PUT'
                    },
                    success: function (data) {
                        console.log(data);
                        // $("#mytable").load(" #mytable");
                        window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });
        });
    </script>




@endsection




