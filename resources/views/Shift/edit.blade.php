@extends('layouts.app')

@section('content')

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('shifts.update',$shift->id) }}" method="POST">

        @csrf

        @method('PUT')


        <div>

            <div>

                <div>

                    <strong>Name:</strong>

                    <input type="text" name="name" value="{{ $shift->name }}" class="form-control" placeholder="Shift Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </form>



@endsection