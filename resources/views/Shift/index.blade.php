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

        <th>Shift</th>

        <th>Action</th>

    </tr>

    @foreach ($shifts as $shift)

        <tr>

            <td>{{ ++$i }}</td>

            <td>{{ $shift->name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('shifts.edit',$shift->id) }}">Edit</a>
                <form onsubmit="return confirm('Do you want to delete?')" action="{{ route('shifts.destroy',$shift->id) }}" method="POST">
                    @csrf

                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

    @endforeach

</table>
@endsection