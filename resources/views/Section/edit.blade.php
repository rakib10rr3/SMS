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
    <form action="{{ route('sections.update',$section->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <div>
                <div>
                    <strong>Section Name:</strong>
                    <input type="text" name="name" value="{{ $section->name }}" class="form-control" placeholder="Section Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>



@endsection