@extends('layouts.app')


@section('content')

<div class="card box-shadow">
	 <div class="card-body">
	    <h4 class="card-title">Preferences</h4>
    	<h6 class="card-subtitle mb-30 text-muted">Change your preference and click <kdb>Save</kdb></h6>
<form action="{{ route('preference.update') }}" method="POST">
	@csrf
	@method('PUT')

	{{-- TODO: all data should come here dynamically. Will do later. (Shohag) --}}
	{{-- NOTE: Note completed. Will Do Late (Shohag) --}}

	<div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Institute Name</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" placeholder="Institute Name" type="text">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Founded Year</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" placeholder="Founded Year" type="text">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Phone Number</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" placeholder="Phone Number" type="text">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">Address</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" placeholder="Address" type="text">
		</div>
	</div>

	<div class="pull-right">
		<button type="submit" class="btn btn-primary mt-30">Save</button>
	</div>
</form>

	</div>
</div>

@endsection
