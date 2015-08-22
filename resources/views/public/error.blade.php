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
                        <div class="col-sm-8 col-sm-offset-2" id="error_panel">
                            <section class="big-icon error-icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </section>
                            <p class="text-lg text-bold text-primary">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </p>
                        </div>
					</div><!--end .row -->
				</div><!--end .card-body -->
			</div><!--end .card -->
		</section>
				<!-- END LOGIN SECTION -->

    {!! HTML::script('js/vendor.js') !!}
</body>
</html>