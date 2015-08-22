	<!-- BEGIN HEADER-->

		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="#">
									<span class="text-lg text-bold text-primary">eHome</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-options">

						<li>
							<!-- Search form -->
							<form class="navbar-search" role="search">
								<div class="form-group">
									<input type="text" class="form-control" name="headerSearch" placeholder="Enter your keyword">
								</div>
								<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
							</form>
						</li>

						{{-- Notifications --}}
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-bell"></i><sup class="badge style-danger">4</sup>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Today's messages</li>
								<li>
									<a class="alert alert-callout alert-warning" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="" alt="" />
										<strong>Alex Anistor</strong><br/>
										<small>Testing functionality...</small>
									</a>
								</li>
								<li>
									<a class="alert alert-callout alert-info" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="" alt="" />
										<strong>Alicia Adell</strong><br/>
										<small>Reviewing last changes...</small>
									</a>
								</li>
								<li class="dropdown-header">Options</li>
								<li><a href="#">View all messages <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
								<li><a href="#">Mark as read <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
							</ul>
						</li>

					</ul>
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="{!! asset('images/icon-user-default.png') !!}" alt="" />
								<span class="profile-info">
									{!! $currentUser->present()->prettyName !!}
									<small>{!! $currentUser->present()->prettyRole !!}</small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Config</li>

								<li><a href="#">Profile</a></li>

								<li><a href="#">My Tasks<span class="badge style-danger pull-right">16</span></a></li>

								<li class="divider"></li>

								<li><a href="{!! route('auth.logout') !!}"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							</ul>
						</li>
					</ul>
					{{--<ul class="header-nav header-nav-toggle">--}}
						{{--<li>--}}
							{{--<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">--}}
								{{--<i class="fa fa-ellipsis-v"></i>--}}
							{{--</a>--}}
						{{--</li>--}}
					{{--</ul>--}}
				</div>
			</div>
		</header>
		<!-- END HEADER-->