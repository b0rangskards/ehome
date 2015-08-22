<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse ">
	<div class="menubar-fixed-panel">
		<div>
			<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		<div class="expanded">
			<a href="{{ route('home') }}">
				<span class="text-lg text-bold text-primary ">eHome</span>
			</a>
		</div>
	</div>
	<div class="menubar-scroll-panel">

		<!-- BEGIN MAIN MENU -->
		<ul id="main-menu" class="gui-controls">

			<!-- BEGIN DASHBOARD -->
			<li>
				<a href="{{ route('home') }}" >
					<div class="gui-icon"><i class="md md-dashboard"></i></div>
					<span class="title">Dashboard</span>
				</a>
			</li>
			<!-- END DASHBOARD -->

			<!-- BEGIN HOUSEHOLD -->
			<li>
				<a href="{{ route('household.index') }}">
					<div class="gui-icon"><i class="md md-people"></i></div>
					<span class="title">My Household</span>
				</a>
			</li>
			<!-- END HOUSEHOLD -->

			<!-- BEGIN TASKS -->
			<li>
				<a href="{{ route('task.index') }}">
					<div class="gui-icon"><i class="md md-event-note"></i></div>
					<span class="title">My Tasks</span>
				</a>
			</li>
			<!-- END TASKS -->

			<!-- BEGIN SUBSCRIPTIONS -->
			<li>
				<a href="#" >
					<div class="gui-icon"><i class="md md-stars"></i></div>
					<span class="title">Subscriptions</span>
				</a>
			</li>
			<!-- END SUBSCRIPTIONS -->

		</ul>
		<!-- END MAIN MENU -->

		<div class="menubar-foot-panel">
			<small class="no-linebreak hidden-folded">
				<span class="opacity-75">Copyright &copy; 2015</span> <strong>eHome</strong>
			</small>
		</div>
	</div>
</div>
<!-- END MENUBAR -->