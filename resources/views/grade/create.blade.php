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

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf
        <div>
            <div>
                <div>
                    <strong>Grade Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Grade Name">
                </div>
            </div>
            <div>
                <div>
                    <strong>Minimum Grade Point:</strong>
                    <input type="text" name="min_point" class="form-control" placeholder="Minimum Grade Point">
                </div>
            </div>
            <div>
                <div>
                    <strong>Maximum Grade Point:</strong>
                    <input type="text" name="max_point" class="form-control" placeholder="Maximum Grade Point">
                </div>
            </div>
            <div>
                <div>
                    <strong>Minimum Mark:</strong>
                    <input type="text" name="min_value" class="form-control" placeholder="Minimum Mark">
                </div>
            </div>
            <div>
                <div>
                    <strong>Maximum Mark:</strong>
                    <input type="text" name="max_value" class="form-control" placeholder="Maximum Mark">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
