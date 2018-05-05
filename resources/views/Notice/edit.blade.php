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
    <form action="{{ route('notices.update',$notice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <div>
                <div>
                    <input hidden type="text" name="user_id" value="{{ $notice->user_id }}" class="form-control">
                </div>
                <div>
                    <strong>Notice Title:</strong>
                    <input type="text" name="title" value="{{ $notice->title }}" class="form-control">
                </div>
                <div>
                    <strong>Message:</strong>
                    <input type="text" name="message" value="{{ $notice->message }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>



@endsection