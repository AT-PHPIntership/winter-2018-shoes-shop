<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('auth/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/main.css') }}">
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
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
