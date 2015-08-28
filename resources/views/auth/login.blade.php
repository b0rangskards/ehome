<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Home</title>

    {!! HTML::style('http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900') !!}
    {!! HTML::style('css/vendor.css') !!}
</head>
<body id="signin_page">

    @include('auth.partials._header')

	<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="card contain-sm style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3" id="signin-body">
							<br/>
							<span class="text-lg text-bold text-primary">Sign In to Continue</span>
							<br/><br/>

							@include('flash::message')

							{!! Form::open(['route' => 'auth.login', 'class' => 'form floating-label']) !!}
								{{-- Email --}}
								<div class="form-group {!! $errors->has('email')?'has-error':'' !!}">
									{!! Form::email('email', null, ['class' => 'form-control']) !!}
									{!! Form::label('email', 'Email') !!}
									<span class="help-block">{!! $errors->first('email') !!}</span>
								</div>
								{{-- Password --}}
								<div class="form-group {!! $errors->has('password')?'has-error':'' !!}">
									{!! Form::password('password', ['class' => 'form-control']) !!}
									{!! Form::label('password', 'Password') !!}
									<span class="help-block">{!! $errors->first('password') !!}</span>
								</div>
								<div class="form-group">
									<p class="help-block"><a href="#">Forgotten?</a></p>
								</div>
								<br/>
								<div class="row">
									<div class="col-xs-6 text-left">
										<div class="checkbox checkbox-inline checkbox-styled">
											<label>
												<input type="checkbox"> <span>Remember me</span>
											</label>
										</div>
									</div>
									{{-- Submit Button --}}
									<div class="col-xs-6 text-right">
									    {!! Form::submit('Login', ['class' => 'btn btn-primary btn-raised']) !!}
									</div>
								</div>
							{!! Form::close() !!}

						</div>
					</div>
				</div>
			</div>
		</section>
				<!-- END LOGIN SECTION -->

    {!! HTML::script('js/vendor.js') !!}
</body>
</html>