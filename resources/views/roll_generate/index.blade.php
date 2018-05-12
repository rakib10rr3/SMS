@extends('layouts.app')

@section('content')


    <div class="col-6">

        <a href="{{route('autoRoll')}}" class="btn btn-outline-success">Generate Automatically</a>
        <a href="{{route('meritRoll')}}" class="btn btn-outline-info">Generate By Merit List</a>
    </div>

@endsection
