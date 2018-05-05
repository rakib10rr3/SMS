@extends('layouts.app')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Waiter Dashboard</div>

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
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">NID</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($waiters as $waiter)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$waiter->name}}</td>
                                    <td>{{$waiter->mobile}}</td>
                                    <td>{{$waiter->address}}</td>
                                    <td>{{$waiter->nid}}</td>

                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary"><a
                                                    style="color:inherit;text-decoration: none;">View</a></button>
                                        <button type="button" class="btn btn-sm btn-info"><a
                                                    style="color:inherit;text-decoration: none;"
                                                    href="/waiter/{{$waiter->id}}/edit">Edit</a></button>
                                        <button type="button" class="btn btn-sm btn-warning"><a
                                                    style="color:inherit;text-decoration: none;"
                                                    href="{{url('/waiter',[$waiter->id])}}">Trash</a></button>
                                        <form class="float-lg-right" action="/waiter/{{$waiter->id}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>
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
