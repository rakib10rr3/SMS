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

            <th>Section</th>

            <th>Action</th>
        </tr>

        @foreach ($sections as $section)

            <tr>

                <td>{{ ++$i }}</td>

                <td>{{ $section->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('sections.edit',$section->id) }}">Edit</a>
                    <form onsubmit="return confirm('Do you want to delete?')" action="{{ route('sections.destroy',$section->id) }}" method="POST">
                        @csrf

                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>
@endsection