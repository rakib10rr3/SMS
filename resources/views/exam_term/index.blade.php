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
                <h5 class="text-blue">Exam Terms Information</h5>

            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th>Serial</th>
                    <th>Exam Term Name</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(empty($examTerms))
                    <p>Data does not exist</p>
                @else
                    @foreach($examTerms as $examTerm)
                        <tr>
                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{$examTerm->name}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/exam-terms/{{$examTerm->id}}/edit"><i
                                                    class="fa fa-pencil"></i> Edit</a>
                                        {{--<form action="{{route('exam-terms.destroy',$examTerm->id)}}" method="post">--}}
                                        {{--{{csrf_field()}}--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button style="cursor: pointer;" type="submit" class="dropdown-item" ><i class="fa fa-trash"></i> Delete</button>--}}
                                        {{--</form>--}}
                                        <a class="dropdown-item ts-delete" href="" data-id="{{$examTerm->id}}"><i
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
                                url: "/exam-terms/"+id,
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




