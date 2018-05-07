@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form action="../getSubjects" method="POST">
        @csrf
        <strong>Select Class to show:</strong>
        <select name="class_id" id="class_id">
            <option value="">Select Class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <table id="show_subjects" class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Subject Name</th>
            <th>Subject Code</th>
            <th>Class</th>
            <th>Action</th>
        </tr>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->code }}</td>
                <td>{{ $subject->class->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('subjects.show',$subject->id) }}">View Details</a>
                    <a class="btn btn-info" href="{{ route('subjects.edit',$subject->id) }}">Edit</a>
                    <form onsubmit="return confirm('Do you want to delete?')" action="{{ route('subjects.destroy',$subject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('#class_id').change(function () {--}}
                {{--var id = $(this).val();--}}
                {{--$.ajax({--}}
                    {{--url:"/getSubjects/",--}}
                    {{--method: "GET",--}}
                    {{--data:{id:id},--}}
                    {{--success: function (data) {--}}
                        {{--$('#show_subjects').html(data.html);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection