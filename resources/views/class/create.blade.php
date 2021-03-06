@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Class</div>

                    <div class="card-body">
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
                        <form method="post" action="/class">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Class Name</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" placeholder="Class Name" id="name"
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
            </div>
        </div>
    </div>

@endsection
