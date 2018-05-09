@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jquery-steps/build/jquery.steps.css')}}">
@endsection

@section('content')

    <form method="post" action="/classAssigns">
        {{csrf_field()}}


        <div class="form-group">
            <label>Class</label>
            <select  id="theclass" class="custom-select2 form-control" name="class_id" style="width: 100%; height: 38px;">
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>Subject</label>
            <select  id="subject" class="custom-select2 form-control" name="subject_id" style="width: 100%; height: 38px;">

                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">
                        {{ $subject->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Teacher</label>
            <select class="custom-select2 form-control" name="teacher_id" style="width: 100%; height: 38px;">

                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">
                        {{ $teacher->name }}
                    </option>
                @endforeach

            </select>
        </div>


        <div class="form-group">
            <label>Section</label>
            <select class="custom-select2 form-control" name="section_id" style="width: 100%; height: 38px;">

                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">
                        {{ $section->name }}
                    </option>
                @endforeach

            </select>
        </div>


        <div class="col-10">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>

    </form>

@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function ($) {
            $('#theclass').change(function(){
                $.get("{{ url('api/dropdown')}}",
                    { option: $(this).val() },
                    function(data) {
                        var subject = $('#subject');
                        subject.empty();

                        $.each(data, function(index, element) {
                            subject.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
        });



    </script>
@endsection




