@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('grades.update',$grade->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <div>
                <div>
                    <strong>Grade Name:</strong>
                    <input type="text" name="name" value="{{ $grade->name }}" class="form-control">
                </div>
                <div>
                    <strong>Minimum Point:</strong>
                    <input type="text" name="min_point" value="{{ $grade->min_point }}" class="form-control">
                </div>
                <div>
                    <strong>Maximum Point:</strong>
                    <input type="text" name="max_point" value="{{ $grade->max_point }}" class="form-control">
                </div>
                <div>
                    <strong>Minimum Mark:</strong>
                    <input type="text" name="min_value" value="{{ $grade->min_value }}" class="form-control">
                </div>
                <div>
                    <strong>Maximum Mark:</strong>
                    <input type="text" name="max_value" value="{{ $grade->max_value }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>



@endsection