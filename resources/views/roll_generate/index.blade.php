@extends('layouts.app')

@section('content')


    <div class="card box-shadow">

        <div class="card-body">

            <h5 class="card-title">Roll Generator</h5>

            <p>Click below button to generator all students roll based on their Final Term Result.</p>

            <div class="alert alert-danger" role="alert">
                Note: Roll Generator must be use after Promotion of all students. <strong>This process is
                    Irreversible</strong>.
            </div>

            {{--<form action="{{route('rollGenerator.generate')}}" method="post">--}}

            <div class="form-group row">
                <label class="col-sm-12 col-form-label" for="session">Current Session Year</label>
                <div class="col-sm-12 col-md-3">
                    <input id="session" value="{{(isset($query))?$query["session"]:(Carbon\Carbon::now()->year)}}"
                           name="session" class="form-control" type="number"
                           min="2000" max="2099" step="1" required/>
                </div>
            </div>

            {{--</form>--}}

            <button id="generate" class="btn btn-primary">Generate Roll For All Class</button>

            <hr>

            <ul id="generate-info">
                <li class="text-success">System Is Idle!</li>
            </ul>

        </div>

    </div>

@endsection

@section('scripts')

    <script>

        $generateButton = $('#generate');
        $generateInfo = $('#generate-info');
        $sessionInput = $('#session');

        $generateButton.click(function () {
            $(this).prop('disabled', true);
            $(this).text("Wait...");
            $sessionInput.prop('disabled', true);

            $generateInfo.empty();

            $classes = [ @foreach($classes as $class) {{ $class->id }}, @endforeach ];
            $classNames = [@foreach($classes as $class) '{{ $class->name }}', @endforeach ];

            $session = $sessionInput.val();

            $length = $classes.length;

            $count = 0;


            generate($count, $session);
        });

        function generate($class, $session) {
            if ($count < $length) {
                $.get("{{ url('api/roll-generator') }}/" + $classes[$class] + "/" + $session,
                    null,
                    function (data) {
                        console.log(data);
                        $count++;

                        $generateInfo.append("<li class='text-info'>Roll Generation of Class "
                            + $classNames[$class] + " Students has been completed.</li>");

                        generate($count, $session);
                    });
            } else {
                $generateButton.prop('disabled', false);
                $generateButton.text('Generate Roll For All Class');
                $sessionInput.prop('disabled', false);

                $generateInfo.append("<li class='text-success'><strong>All Operation Completed!</strong></li>");
            }
        }
    </script>

@endsection