@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Class Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-condensed">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$class->name}}</td>
                                <td>

                                    <button type="button" class="btn btn-sm btn-info"><a
                                                style="color:inherit;text-decoration: none;"
                                                href="/class/{{$class->id}}/edit">Edit</a></button>

                                    {{--<form class="btn btn-sm btn-danger" action="/groups/{{$group->id}}" method="post">--}}
                                    {{--{{csrf_field()}}--}}
                                    {{--{{method_field('DELETE')}}--}}
                                    {{--<button class="btn btn-sm btn-danger" type="submit">Delete</button>--}}
                                    {{--</form>--}}


                                    <button data-toggle="modal" data-target="#confirmation-modal-{{$class->id}}"
                                            class="btn btn-sm btn-danger" type="submit">Delete
                                    </button>


                                    <div class="modal fade" id="confirmation-modal-{{$class->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body text-center font-18">
                                                    <h4 class="padding-top-30 mb-30 weight-500"> Are you sure you want
                                                        to
                                                        continue?</h4>
                                                    <div class="padding-bottom-30 row"
                                                         style="max-width: 170px; margin: 0 auto;">
                                                        <div class="col-6">
                                                            <button type="button"
                                                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                                                    data-dismiss="modal"><i class="fa fa-times"></i>
                                                            </button>
                                                            NO
                                                        </div>

                                                        <div class="col-6">

                                                            {{--<form action="/class/{{ $class->id }}" method="post">--}}
                                                            {{--{{csrf_field()}}--}}
                                                            {{--{{ method_field('DELETE') }}--}}
                                                            {{--<button type="submit"--}}
                                                            {{--class="btn btn-primary border-radius-100 btn-block confirmation-btn"--}}
                                                            {{--data-dismiss="modal"><i class="fa fa-check"></i>--}}
                                                            {{--</button>--}}
                                                            {{--YES--}}
                                                            {{--</form>--}}

                                                            {{----}}
                                                            <button class="deleteProduct" data-id="{{ $class->id }}"
                                                                    data-token="{{ csrf_token() }}">Delete
                                                            </button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection
