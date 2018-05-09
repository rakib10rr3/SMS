@extends('layouts.app') @section('content') @if(isset($success))

<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Success!</strong> Preferences successfully saved!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

@endif



<div class="card box-shadow">
	<div class="card-body">
		<h4 class="card-title">Preferences</h4>
		<h6 class="card-subtitle mb-30 text-muted">Change your preference and click
			<kdb>Save</kdb>
		</h6>
		<form action="{{ route('preference.update') }}" method="POST">
			@csrf @method('PUT') {{-- TODO: all data should come here dynamically. Will do later. (Shohag) --}} {{-- NOTE: Note completed.
			Will Do Late (Shohag) --}}

			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Institute Name</label>
				<div class="col-sm-12 col-md-10">
					<input name="institute_name" class="form-control" placeholder="Institute Name" type="text" value="{{ $assoc_preferences['institute_name'] }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Founded Year</label>
				<div class="col-sm-12 col-md-10">
					<input name="founded_year" class="form-control" placeholder="Founded Year" type="text" value="{{ $assoc_preferences['founded_year'] }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Phone Number 1</label>
				<div class="col-sm-12 col-md-10">
					<input name="phone_number_1" class="form-control" placeholder="Phone Number" type="text" value="{{ $assoc_preferences['phone_number_1'] }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Phone Number 2</label>
				<div class="col-sm-12 col-md-10">
					<input name="phone_number_2" class="form-control" placeholder="Phone Number" type="text" value="{{ $assoc_preferences['phone_number_2'] }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Phone Number 3</label>
				<div class="col-sm-12 col-md-10">
					<input name="phone_number_3" class="form-control" placeholder="Phone Number" type="text" value="{{ $assoc_preferences['phone_number_3'] }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Address</label>
				<div class="col-sm-12 col-md-10">
					<input name="address" class="form-control" placeholder="Address" type="text" value="{{ $assoc_preferences['address'] }}">
				</div>
			</div>

			<div class="pull-right">
				<button type="submit" class="btn btn-primary mt-30">Save</button>
			</div>
		</form>

	</div>
</div>

@endsection