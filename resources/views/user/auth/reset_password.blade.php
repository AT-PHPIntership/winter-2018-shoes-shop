<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="text-center">
								<h3><i class="fa fa-lock fa-4x"></i></h3>
								<h2 class="text-center">{{ trans('login.change_password') }}</h2>
								<div>
									@include('user.module.message')
								</div>
								<div class="panel-body">
									<form id="register-form" role="form" autocomplete="off" class="form" method="POST" action="{{ route('user.password.reset') }}">
										{{ csrf_field() }}
										<input type="hidden" name="token" value="{{ $token }}">
										<div class="form-group">
											<label for="password">{{ trans('login.new_password') }}</label>
											<input name="password" type="password" class="form-control">
											@if ($errors->has('password'))
												<span style="color:red">{{ $errors->first('password') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label for="confirm_password">{{ trans('login.confirm_password') }}</label>
											<input name="confirm_password" type="password" class="form-control">
											@if ($errors->has('confirm_password'))
												<span style="color:red">{{ $errors->first('confirm_password') }}</span>
											@endif
										</div>
										<div class="form-group">
											<button class="btn btn-lg btn-primary btn-block" type="submit">Lưu</button>
										</div>
									</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
