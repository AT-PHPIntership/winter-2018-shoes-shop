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
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('password.reset') }}">
                        <h3>Reset Password</h3>
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            @if ($errors->has('password'))
                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            @if ($errors->has('password_confirmation'))
                            <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                            @endif
                            <input type="password_confirmation" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"/>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Reset Password</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
