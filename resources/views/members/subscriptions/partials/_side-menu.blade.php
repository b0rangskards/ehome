<!-- BEGIN SEARCH NAV -->
<div class="col-sm-3">
    <div class="nav-action">
        <h4 class="inline-block">Subscriptions</h4>
        <hr/>
    </div>

	<ul class="nav nav-pills nav-stacked nav-transparent nav-no-border">
		<li class="text-muted">
		    <a href="{{route('subscriptions.index')}}"><i class="md md-stars"></i>&nbsp;&nbsp;Subscriptions
		    </a>
		</li>
		<li class="text-muted">
            <a href="{{route('subscriptions.history', $currentUser->id)}}"><i class="fa fa-history"></i>&nbsp;&nbsp;&nbsp;History
            </a>
        </li>
		<li class="text-muted">
            <a href="#"><i class="fa fa-book"></i>&nbsp;&nbsp;View Report
            </a>
        </li>
	</ul>

</div>
<!-- END SEARCH NAV -->