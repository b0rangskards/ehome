	<!-- BEGIN HEADER-->
		<header id="header" class="header-inverse">
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="{{route('home')}}">
									<img src="{{asset('images/2_corporate/logo.png')}}" alt=""/>
								</a>
							</div>
						</li>
						{{--<li>--}}
							{{--<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">--}}
								{{--<i class="fa fa-bars"></i>--}}
							{{--</a>--}}
						{{--</li>--}}
					</ul>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-options">
						{{-- Notifications --}}
						<li class="dropdown">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-bell text-default-light"></i>
								{{--@if(count($currentUser->unseenNotifications) > 0)--}}
								    <sup class="badge style-danger {{count($currentUser->unseenNotifications)?'show':'hidden'}}" id="notifications-ctr">{{count($currentUser->unseenNotifications)}}</sup>
								{{--@endif--}}
							</a>
							<ul class="dropdown-menu animation-expand notifications-ul">
								<li class="dropdown-header">Notifications</li>
								<li id="notifications-list">
								    @forelse($currentUser->notifications->take(7) as $notification)
                                        @include('members.partials._notification-item')
									@empty
									    <p class="text-center text-muted">You have no notifications.</p>
									@endforelse
								</li>
								@if(count($currentUser->notifications) > 0)
								    <li><a href="{{route('notification.index')}}">View all Notifications<span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
							    @endif
							</ul>
						</li>

					</ul>
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="{{ asset('images/icon-user-default.png') }}" alt="" />
								<span class="profile-info">
									{!! $currentUser->present()->prettyName !!}
									<small>{!! $currentUser->present()->prettyRole !!}</small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Config</li>

								<li><a href="{{route('profile.index', $currentUser->present()->slugName)}}">Profile</a></li>

								<li><a href="{{route('task.index')}}">My Tasks
                                    @if($currentUser->pendingTasks()->count())
                                        <span class="badge style-danger pull-right">{{$currentUser->pendingTasks()->count()}}</span>
                                    @endif
								</a></li>

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