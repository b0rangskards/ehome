<!-- BEGIN ALERT - TIME ON SITE -->
<div class="col-md-3 col-sm-6">
	<div class="card">
		<div class="card-body no-padding">
			<div class="alert alert-callout alert-danger no-margin">
				<h1 class="pull-right text-danger"><i class="md md-timer-off"></i></h1>
				<strong class="text-xl"><a href="{{route('subscriptions.extend', $user->id)}}">Click here</a></strong><br/>
				<span class="opacity-50">Subscription has expired</span>
			</div>
		</div><!--end .card-body -->
	</div><!--end .card -->
</div><!--end .col -->
<!-- END ALERT - TIME ON SITE -->