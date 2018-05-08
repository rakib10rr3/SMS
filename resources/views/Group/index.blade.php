@extends('layouts.app')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Group Dashboard</div>

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
                            @foreach($groups as $group)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$group->name}}</td>
                                    <td>

                                        <button type="button" class="btn btn-sm btn-info"><a
                                                    style="color:inherit;text-decoration: none;"
                                                    href="/groups/{{$group->id}}/edit">Edit</a></button>

                                        <form class="btn btn-sm btn-danger" action="/groups/{{$group->id}}" method="post">
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
