@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>
                {{ $subject->theClass->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject Name:</strong>
                {{ $subject->name }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject Code:</strong>
                {{ $subject->code }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Full marks:</strong>
                {{ $subject->full_marks }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pass marks:</strong>
                {{ $subject->pass_marks }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Written: </strong>
                @if($subject->has_written==1)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="display: {{ ($subject->has_written==1)?'':'none' }}">
            <div class="form-group">
                <strong>Written marks:</strong>
                {{ $subject->written_marks }}
            </div>
            <div class="form-group">
                <strong>Written pass marks:</strong>
                {{ $subject->written_pass_marks }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>MCQ: </strong>
                @if($subject->has_mcq==1)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="display: {{ ($subject->has_mcq==1)?'':'none' }}">
            <div class="form-group">
                <strong>MCQ marks:</strong>
                {{ $subject->mcq_marks }}
            </div>
            <div class="form-group">
                <strong>MCQ pass marks:</strong>
                {{ $subject->mcq_pass_marks }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Practical: </strong>
                @if($subject->has_practical==1)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="display: {{ ($subject->has_practical==1)?'':'none' }}">
            <div class="form-group">
                <strong>Practical marks:</strong>
                {{ $subject->practical_marks }}
            </div>
            <div class="form-group">
                <strong>Practical pass marks:</strong>
                {{ $subject->practical_pass_marks }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Optional: </strong>
                @if($subject->is_optional==1)
                    Yes
                @else
                    No
                @endif
            </div>
        </div>
    </div>

@endsection