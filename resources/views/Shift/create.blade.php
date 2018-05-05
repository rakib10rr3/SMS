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

    <form action="{{ route('shifts.store') }}" method="POST">
        @csrf
        <div>
            <div>
                <div>
                    <strong>Shift Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Shift Name">
                </div>

            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
