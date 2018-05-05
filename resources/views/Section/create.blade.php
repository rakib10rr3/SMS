@extends('layouts.app')

@section('content')
    @if ($errors->any())

        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sections.store') }}" method="POST">
        @csrf
        <div>
            <div>
                <div>
                    <strong>Section Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Section Name">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
