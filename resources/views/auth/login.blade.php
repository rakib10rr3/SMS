<!DOCTYPE html>
<html>

<head>

    @include('layouts.header')
</head>

<body>

    <div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
        <div class="login-box bg-white box-shadow pd-30 border-radius-5">


            <img src="/vendors/images/logo.svg" alt="login" class="login-img">
            <h1 class="text-center">{{ config('app.name', 'Management System') }}</h1>

            <h3 class="text-center mb-30">Login</h3>

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="input-group custom input-group-lg">

                    {{--
                    <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}} {{--
                    <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" --}} {{--name="username"
                        value="{{ old('username') }}" required autofocus>--}} {{----}}
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="Username"
                        value="{{ old('username') }}" required>
                    <div class="input-group-append custom">
                        <span class="input-group-text">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif

                    <div class="input-group-append custom">
                        <span class="input-group-text">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>

                <div class="input-group custom input-group-lg">
                    {{--
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}} {{--
                    <input id="password" type="password" --}} {{--class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        required>--}}
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                        
                    @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                    <div class="input-group-append custom">
                        <span class="input-group-text">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div class="input-group custom input-group-lg">

                    <div class="custom-control custom-checkbox mb-5">
                        <input class="custom-control-input" id="customCheck1-1" type="checkbox" name="remember" {{ old( 'remember') ? 'checked' :
                            '' }}>
                        <label class="custom-control-label" for="customCheck1-1">{{ __('Remember Me') }}</label>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                {{ __('Sign In') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a class="forgot-password padding-top-10" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>


            </form>

        </div>
    </div>
    @include('layouts.script')
</body>

</html>