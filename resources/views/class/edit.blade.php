@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($class as $class)
                    <div class="card-header">Edit Class : <b>{{$class->name}}</b></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="/class/{{$class->id}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Name</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" placeholder="Rakibul Huda" value="{{$class->name}}" id="name"
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
