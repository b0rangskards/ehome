<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Home</title>

    {!! HTML::style('http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900') !!}
    {!! HTML::style('css/vendor.css') !!}
    <style>
    .pixfort_corporate_2 .header_style{
        background-color: #414a52;

    }
    .pixfort_corporate_2 .header_area{
        position: absolute;
        padding-top: 35px;
        z-index: 2;
    }
    </style>
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
							<form class="form floating-label" action="../../html/dashboards/dashboard.html" accept-charset="utf-8" method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="username" name="username">
									<label for="username">Username</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password">
									<label for="password">Password</label>
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
									</div><!--end .col -->
									<div class="col-xs-6 text-right">
										<button class="btn btn-primary btn-raised" type="submit">Login</button>
									</div><!--end .col -->
								</div><!--end .row -->
							</form>
						</div><!--end .col -->

					</div><!--end .row -->
				</div><!--end .card-body -->
			</div><!--end .card -->
		</section>
				<!-- END LOGIN SECTION -->

    {!! HTML::script('js/vendor.js') !!}
</body>
</html>