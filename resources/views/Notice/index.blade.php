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

            <th>User name</th>

            <th>Notice Title</th>

            <th>Notice Message</th>

            <th>Action</th>
        </tr>

        @foreach ($notices as $notice)

            <tr>

                <td>{{ ++$i }}</td>

                <td> {{ $notice->user->name }}</td>

                <td>{{ $notice->title }}</td>

                <td>{{ $notice->message }}</td>
                @if($notice->user_id == Auth::user()->id)
                <td>
                    <a class="btn btn-info" href="{{ route('notices.edit',$notice->id) }}">Edit</a>
                    <form onsubmit="return confirm('Do you want to delete?')" action="{{ route('notices.destroy',$notice->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>

                </td>
                @endif

            </tr>

        @endforeach

    </table>
@endsection