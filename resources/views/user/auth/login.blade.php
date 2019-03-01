<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('auth/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/style.css') }}">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <form method="POST" action="{{ route('user.login') }}" class="login100-form validate-form">
                    @csrf
					<span class="login100-form-title p-b-26">
						@lang('login.welcome')
					</span>
					<span class="dis-block text-center">{{ request()->has('regis_success') ? request()->get('regis_success') : '' }}</span>
					<div class="wrap-input100 validate-input">
                        <input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    @if ($errors->has('email'))
                        <span class="cl-red">{{ $errors->first('email') }}</span>
                    @endif
					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" placeholder="Password" required>
                    </div>
                    @if ($errors->has('password'))
                        <span class="cl-red">{{ $errors->first('password') }}</span>
					@endif
					<div class="p-t-10">
						<input type="checkbox" name="remember" value="Remember Me">
						<span class="txt1">{{ __('Remember Me') }}</span>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								{{ __('Login') }}
							</button>
						</div>
						<div>
							<a class="reset_pass" href="{{route('user.password.request')}}">Quên mật khẩu?</a>
						</div>
						</div>
					<div class="box-social text-uppercase p-t-30">
						<a href="{{url('facebook/redirect')}}" class="btn btn-success">@lang('login.facebook')</a>
						<a href="{{url('google/redirect')}}" class="btn btn-danger">@lang('login.google+')</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
