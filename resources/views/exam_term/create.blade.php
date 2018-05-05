@extends('layouts.app')

@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue">Create Exam Terms</h4>
                <p class="mb-30 font-14">All bootstrap element classies</p>
            </div>
        </div>
        <form method="post" action="/exam-terms">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Text</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" placeholder="" name="name" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label"></label>
                <div class="col-sm-12 col-md-10">
                    <button class="btn btn-success" type="submit" value="Add">Add</button>
                </div>
            </div>

        </form>
	</div>
@endsection
