@extends('layouts.app')
<!-- -->
@section('styles')
    <!-- -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/media/css/responsive.dataTables.css">
    <!-- -->
@endsection
<!-- -->
@section('content')
    <!-- -->

    @if(isset($error_message))
        <div class="alert alert-danger" role="alert">
            {{$error_message}}
        </div>
    @endif

    <form action="" method="post">

        @csrf

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue">To Add Marks, select below fields and click
                        <span class="badge badge-primary">Go</span>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="theclass">Class</label>
                    <select class="form-control custom-select" name="theclass"
                            id="theclass" {{ (isset($disable_form))? 'disabled': '' }}>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ (isset($query))? ( ($query[ 'theclass']==$class->id)?'selected':'' ) :'' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="section">Section</label>
                    <select class="form-control custom-select" name="section"
                            id="section" {{ (isset($disable_form))? 'disabled': '' }}>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ (isset($query))? ( ($query[ 'section']==$section->id)?'selected':'' ) :'' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="shift">Shift</label>
                    <select class="form-control custom-select" name="shift"
                            id="shift" {{ (isset($disable_form))? 'disabled': '' }}>
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->id }}" {{ (isset($query))? ( ($query[ 'shift']==$shift->id)?'selected':'' ) :'' }}>{{ $shift->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="shift">Group</label>
                    <select class="form-control custom-select" name="group"
                            id="group" {{ (isset($disable_form))? 'disabled': '' }}>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ (isset($query))? ( ($query[ 'group']==$group->id)?'selected':'' ) :'' }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="session">Session Year</label>
                    <input type="year" value="{{ (isset($query))?$query['session']: \Carbon\Carbon::now()->year }}"
                           class="form-control" name="session"
                           id="session" placeholder="1971" {{ (isset($disable_form))? 'disabled': '' }}>
                </div>

                <div class="form-group col-md-6">
                    <label for="exam_term">Exam Term</label>
                    <select class="form-control custom-select" name="exam_term"
                            id="exam_term" {{ (isset($disable_form))? 'disabled': '' }}>
                        @foreach($exam_terms as $exam_term)
                            <option value="{{ $exam_term->id }}" {{ (isset($query))? ( ($query[ 'exam_term']==$exam_term->id)?'selected':'' ) :'' }}>{{ $exam_term->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Go</button>

        </div>


    </form>

@endsection
<!-- -->
@section('scripts')


    <script>

    </script>


@endsection