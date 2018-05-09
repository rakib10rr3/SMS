@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">
@endsection

@section('content')
    <form method="post" action="/classAssigns/{{$classAssign->id}}">
        {{csrf_field()}}


        <div class="form-group">
            <label>Class</label>
            <select class="custom-select2 form-control" name="class_id" style="width: 100%; height: 38px;">
                @foreach ($classes as $class)
                    <option value="{{$class->id}}" {{ $class->id === $classAssign->class_id? 'selected' : '' }}>{{$class->name}}

                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>Subject</label>
            <select class="custom-select2 form-control" name="subject_id" style="width: 100%; height: 38px;">

                @foreach ($subjects as $subject)

                    <option value="{{$subject->id}}" {{ $subject->id === $classAssign->subject_id? 'selected' : '' }}>{{$subject->name}}

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Teacher</label>
            <select class="custom-select2 form-control" name="teacher_id" style="width: 100%; height: 38px;">

                @foreach ($teachers as $teacher)

                    <option value="{{$teacher->id}}" {{ $teacher->id === $classAssign->teacher_id? 'selected' : '' }}>{{$teacher->name}}

                @endforeach

            </select>
        </div>


        <div class="form-group">
            <label>Section</label>
            <select class="custom-select2 form-control" name="section_id" style="width: 100%; height: 38px;">

                @foreach ($sections as $section)

                    <option value="{{$section->id}}" {{ $section->id === $classAssign->section_id? 'selected' : '' }}>{{$section->name}}

                @endforeach

            </select>
        </div>


        <div class="col-10">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>

    </form>
@endsection



<!-- Form wizard Js  -->
@section('scripts')

    <script src="{{asset('src/plugins/jquery-steps/build/jquery.steps.js')}}"></script>
    <script>
        $(".tab-wizard").steps({
            headerTag: "h5",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onFinished: function (event, currentIndex) {
                // $('#success-modal').modal('show');
                $("#form").submit();
            }
        });
    </script>

@endsection



