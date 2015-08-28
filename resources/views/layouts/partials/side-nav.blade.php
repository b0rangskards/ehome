			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse">
				<div class="menubar-fixed-panel">
					<div>
						<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="expanded">
						<a href="{!! route('admin.dashboard') !!}">
							<span class="text-lg text-bold text-primary ">eHome&nbsp;Admin</span>
						</a>
					</div>
				</div>
				<div class="menubar-scroll-panel">

					<ul id="main-menu" class="gui-controls">
						<li>
							<a href="{!! route('admin.dashboard') !!}"  data-toggle="tooltip" data-placement="right" title="Dashboard">
								<div class="gui-icon"><i class="md md-dashboard"></i></div>
								<span class="title">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="{{route('admin.users.index')}}"  data-toggle="tooltip" data-placement="right" title="Users">
								<div class="gui-icon"><i class="md md-contacts"></i></div>
								<span class="title">Users</span>
							</a>
						</li>

						<li>
							<a href="#"  data-toggle="tooltip" data-placement="right" title="Subscriptions">
								<div class="gui-icon"><i class="md md-stars"></i></div>
								<span class="title">Subscriptions</span>
							</a>
						</li>
						<li>
							<a href="#"  data-toggle="tooltip" data-placement="right" title="Reports">
								<div class="gui-icon"><i class="md md-assessment"></i></div>
								<span class="title">Reports</span>
							</a>
						</li>
					</ul>

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2015</span> <strong>eHome</strong>
						</small>
					</div>
				</div>
			</div>
