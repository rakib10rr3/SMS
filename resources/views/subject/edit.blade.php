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
    <form action="{{ route('subjects.update',$subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <div>
                <div>
                    <div>
                        <strong>Select Class:</strong>
                        <select name="class_id" class="form-control">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <div>
                        <strong>Subject Name:</strong>
                        <input type="text" name="name" class="form-control" value="{{ $subject->name }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Subject Code:</strong>
                        <input type="text" name="code" class="form-control" value="{{ $subject->code }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Full marks:</strong>
                        <input type="text" name="full_marks" class="form-control" value="{{ $subject->full_marks }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Pass marks:</strong>
                        <input type="text" name="pass_marks" class="form-control" value="{{ $subject->pass_marks }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Written Pass Marks:</strong>
                        <input type="text" name="written_pass_marks" class="form-control" value="{{ $subject->written_pass_marks }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>MCQ Pass Marks:</strong>
                        <input type="text" name="mcq_pass_marks" class="form-control" value="{{ $subject->mcq_pass_marks }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Practical Pass Marks:</strong>
                        <input type="text" name="practical_pass_marks" class="form-control" value="{{ $subject->practical_pass_marks }}">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>



@endsection