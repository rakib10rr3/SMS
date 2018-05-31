@extends('layouts.app')


@section('content')

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
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue">Reset Users Password</h4>
                <p class="mb-30 font-14">Enter below fields and click <span class="badge badge-secondary">Change Password</span>
                </p>
            </div>
        </div>
        <form action="" method="POST">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input value="{{old('name')}}" class="form-control" name="name" type="text"
                       style="width: 100%; height: 38px;">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input value="{{old('pass')}}" class="form-control" name="pass" type="text"
                       style="width: 100%; height: 38px;">
            </div>

            <input class="btn btn-primary" type="submit" value="Change Password">
        </form>
    </div>

@endsection


@section('scripts')



@endsection
