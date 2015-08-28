<div class="card card-underline style-default-dark">
	<div class="card-head">
		<header class="opacity-75"><small>Personal info</small></header>
		<div class="tools">
			<a href="{{route('profile.edit', $currentUser->id)}}" class="btn btn-icon-toggle ink-reaction"><i class="md md-edit"></i></a>
		</div>
	</div>
	<div class="card-body no-padding">
		<ul class="list">
			<li class="tile">
        		<a class="tile-content ink-reaction">
        			<div class="tile-icon">
        				<i class="md md-account-circle"></i>
        			</div>
        			<div class="tile-text">
        				{{$currentUser->present()->prettyName}}
        				<small>Name</small>
        			</div>
        		</a>
        	</li>
        	<li class="tile">
            	<a class="tile-content ink-reaction">
            		<div class="tile-icon">
            		</div>
            		<div class="tile-text">
            			{{$currentUser->present()->prettyGender}}
            			<small>Gender</small>
            		</div>
            	</a>
            </li>
        	@if($currentUser->mobile_no)
			<li class="tile">
				<a class="tile-content ink-reaction">
					<div class="tile-icon">
						<i class="fa fa-phone"></i>
					</div>
					<div class="tile-text">
						{{$currentUser->mobile_no}}
						<small>Mobile</small>
					</div>
				</a>
			</li>
			@endif
			<li class="tile">
				<a class="tile-content ink-reaction">
					<div class="tile-icon">
					    <i class="md md-mail"></i>
					</div>
					<div class="tile-text">
						{{$currentUser->email}}
						<small>Email</small>
					</div>
				</a>
			</li>
			<li class="divider-inset"></li>
			{{-- Household Address --}}
			@if($currentUser->household)
			<li class="tile">
            	<a class="tile-content ink-reaction">
            		<div class="tile-icon">
            			<i class="md md-location-on"></i>
            		</div>
            		<div class="tile-text">
            			{{$currentUser->household->present()->prettyAddress}}
            			<small>Address</small>
            		</div>
            	</a>
            </li>
            @endif
            <li class="tile">
            	<a class="tile-content ink-reaction">
            		<div class="tile-icon">
            		    <i class="fa fa-globe"></i>
            		</div>
            		<div class="tile-text">
            			{{$currentUser->present()->dateRegistered}}
            			<small>Member Since</small>
            		</div>
            	</a>
            </li>
		</ul>
	</div><!--end .card-body -->
</div><!--end .card -->
