<!-- BEGIN PROFILE HEADER -->
<section class="full-bleed">
	<div class="section-body style-default-dark force-padding text-shadow">
		<div class="overlay overlay-shade-top stick-top-left height-3"></div>
		<div class="row">
			<div class="col-md-3 col-xs-5">
				<img class="img-circle border-white border-xl img-responsive auto-width height-4"  src="{{asset('images/icon-user-default.png')}}" alt="" />
				<h3>{{$currentUser->present()->prettyName}}<br/><small>{{$currentUser->present()->prettyCompleteRole}}</small></h3>
			</div><!--end .col -->
			 <div class="width-7 text-center pull-right">
                 <strong class="text-xxl">Task</strong>
             </div>
			<div class="col-md-9 col-xs-7">
				<div class="width-3 text-center pull-right">
					<strong class="text-xl">{{$currentUser->pendingTasks()?$currentUser->pendingTasks()->count():0}}</strong><br/>
					<span class="text-light opacity-75">Pending</span>
				</div>
				<div class="width-3 text-center pull-right">
					<strong class="text-xl">{{$currentUser->completedTasks()?$currentUser->completedTasks()->count():0}}</strong><br/>
					<span class="text-light opacity-75">Completed</span>
				</div>
			</div><!--end .col -->
		</div><!--end .row -->
		<div class="overlay overlay-shade-bottom stick-bottom-left force-padding text-right text-xl">
			{{-- Settings --}}
			<a class="btn btn-icon-toggle" href="{{route('profile.settings', $currentUser->present()->slugName)}}" data-toggle="tooltip" data-placement="top" data-original-title="Settings"><i class="md md-settings"></i></a>
            {{-- User Tasks--}}
			@if(!$currentUser->isAdmin())
			    <a class="btn btn-icon-toggle" href="{{route('task.index')}}" data-toggle="tooltip" data-placement="top" data-original-title="Tasks"><i class="md md-event-note"></i></a>
			@endif
			{{-- User Subscriptions --}}
			@if($currentUser->isHead())
			    <a class="btn btn-icon-toggle" href="{{route('subscriptions.index')}}" data-toggle="tooltip" data-placement="top" data-original-title="Subscriptions"><i class="md md-stars"></i></a>
			@endif
		</div>
	</div><!--end .section-body -->
</section>
<!-- END PROFILE HEADER  -->