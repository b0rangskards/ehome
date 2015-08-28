<div class="card card-underline style-default-dark">
	<div class="card-head">
		<header class="opacity-75">
			<small>Household Members</small>
		</header>
		<div class="tools">
			<form class="navbar-search" role="search">
				<div class="form-group">
					<input type="text" class="form-control" name="friendSearch" placeholder="Enter your keyword">
				</div>
				<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<!--end .tools -->
	</div>
	<!--end .card-head -->
	<div class="card-body no-padding">
		<ul class="list">
		    @forelse($currentUser->memberHousehold as $member)
			<li class="tile">
				<a class="tile-content ink-reaction" href="#2">
					<div class="tile-icon">
						<img src="{{asset('images/icon-user-default.png')}}" alt=""/>
					</div>
					<div class="tile-text">{{$member->user->present()->prettyName}}
						<small>{{$member->user->present()->prettyRole}}</small>
					</div>
				</a>
			</li>
			@empty
			    <li class="tile">
			        <p class="text-center small-padding">No members yet.</p>
			    </li>
			@endforelse
		</ul>
	</div>
	<!--end .card-body -->
</div><!--end .card -->