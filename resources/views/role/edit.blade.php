@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($role as $role)
                    <div class="card-header">Edit Waiter : <b>{{$role->name}}</b></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="/roles/{{$role->id}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Name</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" placeholder="Role" value="{{$role->name}}" id="name"
                                               name="name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-color-input" class="col-2 col-form-label"></label>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-outline-success">Update</button>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
