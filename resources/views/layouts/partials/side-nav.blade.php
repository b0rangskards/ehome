			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse ">
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

					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">

						<!-- BEGIN DASHBOARD -->
						<li>
							<a href="{!! route('admin.dashboard') !!}" >
								<div class="gui-icon"><i class="md md-dashboard"></i></div>
								<span class="title">Dashboard</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->

						<!-- BEGIN DASHBOARD -->
						<li>
							<a href="#" >
								<div class="gui-icon"><i class="md md-contacts"></i></div>
								<span class="title">Users</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->

						<!-- BEGIN CHARTS -->
						<li>
							<a href="#" >
								<div class="gui-icon"><i class="md md-stars"></i></div>
								<span class="title">Subscriptions</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END CHARTS -->

						<!-- BEGIN CHARTS -->
						<li>
							<a href="#" >
								<div class="gui-icon"><i class="md md-assessment"></i></div>
								<span class="title">Reports</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END CHARTS -->

					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2015</span> <strong>eHome</strong>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->