@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
@section('content')

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <div class="form-group pd-20 bg-white border-radius-4 box-shadow mb-30">
            <form action="{{route('print.show')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Class:</label>
                            <select id="the_class_id" class="custom-select2 form-control" name="the_class_id"
                                    style="width: 100%; height: 38px;">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Section:</label>
                            <select id="section_id" class="custom-select2 form-control" name="section_id"
                                    style="width: 100%; height: 38px;">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Group:</label>
                            <select id="group_id" class="custom-select2 form-control" name="group_id"
                                    style="width: 100%; height: 38px;">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Shift:</label>
                            <select id="shift_id" class="custom-select2 form-control" name="shift_id"
                                    style="width: 100%; height: 38px;">
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">
                                        {{ $shift->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <label>Session :</label>
                            <input type="number" class="form-control" placeholder="Select Session Year"
                                   id="session_year"
                                   min="2000" max="2099" name="session_year"
                                   value="{{Carbon\Carbon::now()->format('Y')}}" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group col-md-6">
                            <label for="exam_term">Exam Term</label>
                            <select class="form-control custom-select" name="exam_term" id="exam_term">
                                @foreach( $examTerms as $exam_term)
                                    <option value="{{ $exam_term->id }}" selected>{{ $exam_term->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>

                <button id="btn-generate" name="btn-generate" class="btn btn-success">Get Merit List</button>
            </form>
        </div>

    </div>
@endsection



