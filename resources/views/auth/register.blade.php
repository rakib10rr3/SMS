<!DOCTYPE html>
<html>

<head>

    @include('layouts.header')
</head>

<body>

    <div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">

        <div class="login-box bg-white box-shadow pd-30 border-radius-5">

            <img src="vendors/images/logo.svg" alt="login" class="login-img">
            <h1 class="text-center">{{ config('app.name', 'Education Management System') }}</h1>

            <h3 class="text-center mb-30">Register (DEMO)</h3>


            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 control-label">Name</label>

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your Name" required autofocus>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-md-12 control-label">Username</label>

                    <div class="col-md-12">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Your User Name" required>
                        @if ($errors->has('username'))
                            <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-12 control-label">Password</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Your Password" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-12 control-label">Confirm Password</label>

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Your Password (again)" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                            Register
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    @include('layouts.script')
</body>

</html>