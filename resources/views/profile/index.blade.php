@extends('profile.partials._master-layout')

@section('content')

@include('profile.partials._profile-header')

<section>
	<div class="section-body no-margin">
		<div class="row">
            {{-- Flash Messages --}}
            @include('flash::message')

            @include('profile.partials._profile-body')

			<!-- BEGIN PROFILE MENUBAR -->
			<div class="col-lg-offset-1 col-lg-4 col-md-5">

                @include('profile.partials._user-info')

                @if(!$currentUser->isAdmin())
                    @include('profile.partials._household-members')
                @endif
			</div>
			<!-- END PROFILE MENUBAR -->

		</div>
	</div>
</section>


@stop