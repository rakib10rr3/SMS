@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Gender</div>
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
                    <div class="card-body">



                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($genders as $gender)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$gender->name}}</td>

                                <td>
                                    <button type="button" class="btn btn-outline-success"><a
                                                style="color:inherit;text-decoration: none;">View</a></button>
                                    <button type="button" class="btn btn-outline-info"><a
                                                style="color:inherit;text-decoration: none;"
                                                href="/genders/{{$gender->id}}/edit">Edit</a></button>
                                    <form class="float-lg-right" action="/genders/{{$gender->id}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-outline-danger" type="submit">Delete</button>
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
    </div>
@endsection