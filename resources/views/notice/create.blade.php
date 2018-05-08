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

    <form action="{{ route('notices.store') }}" method="POST">
        @csrf
        <div>
            <div>
                <div>
                    <input hidden type="text" name="user_id" class="form-control" value={{ Auth::user()->id }}>
                </div>
                <div>
                    <strong>Notice Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Notice Title">
                </div>
                <div>
                    <strong>Notice Message:</strong>
                    <input type="text" name="message" class="form-control" placeholder="Message">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
