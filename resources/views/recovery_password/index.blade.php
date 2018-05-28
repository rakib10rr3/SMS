@extends('layouts.app')


@section('content')

    <!-- Select-2 Start -->
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue">Password Recovery</h4>
                <p class="mb-30 font-14">Enter below fields and click <span class="badge badge-secondary">submit</span>.</p>
            </div>
        </div>
        <form action="" method="POST">
            @csrf

            <div class="form-group">
                <label>User Name</label>
                <input class="form-control" name="username" type="text" style="width: 100%; height: 38px;">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="password" type="text" style="width: 100%; height: 38px;">
            </div>

            <input class="btn btn-primary" type="submit" value="Change Password">
        </form>
    </div>
    <!-- Select-2 end -->

@endsection


@section('scripts')



@endsection
