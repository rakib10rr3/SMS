@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Grade</th>
            <th>Minimum Point</th>
            <th>Maximum Point</th>
            <th>Minimum Value</th>
            <th>Maximum Value</th>
            <th>Action</th>
        </tr>
        @foreach ($grades as $grade)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $grade->name }}</td>
                <td>{{ $grade->min_point }}</td>
                <td>{{ $grade->max_point }}</td>
                <td>{{ $grade->min_value }}</td>
                <td>{{ $grade->max_value }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('grades.edit',$grade->id) }}">Edit</a>
                    <form onsubmit="return confirm('Do you want to delete?')" action="{{ route('grades.destroy',$grade->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection