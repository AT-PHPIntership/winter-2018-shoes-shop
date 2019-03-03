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
								<h2 class="text-center">{{ trans('login.forget_password') }}</h2>
								<p>{{ trans('login.enter_email_reset') }}?</p>
									<div>
										@include('user.module.message')
									</div>
								<div class="panel-body">
									<form id="register-form" role="form" autocomplete="off" class="form" method="POST" action="{{ route('user.password.email') }}">
										{{ csrf_field() }}
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
												<input id="email" name="email" placeholder="email address" class="form-control"  type="email">
											</div>
											@if ($errors->has('email'))
												<span style="color:red">{{ $errors->first('email') }}</span>
											@endif
										</div>
										<div class="form-group">
											<button class="btn btn-lg btn-primary btn-block" type="submit">{{ trans('login.reset_password') }}</button>
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
