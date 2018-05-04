<!DOCTYPE html>
<html>
<head>

    @include('layouts.header')
</head>
<body>

<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
    <div class="login-box bg-white box-shadow pd-30 border-radius-5">

        <img src="vendors/images/login-img.png" alt="login" class="login-img">
        <h2 class="text-center mb-30">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="input-group custom input-group-lg">

                {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"--}}
                {{--name="email" value="{{ old('email') }}" required autofocus>--}}
                {{----}}
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" placeholder="Email" value="{{ old('email') }}" required>
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                </div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                </div>
            </div>

            <div class="input-group custom input-group-lg">
                {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}
                {{--<input id="password" type="password"--}}
                       {{--class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}
               {{----}}
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-6">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <!--
                            use code for form submit
                            <input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Sign In">
                        -->
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
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