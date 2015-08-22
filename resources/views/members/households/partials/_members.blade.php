    <div class="list-results">

        @forelse($householdMembers as $member)

	    <div class="col-xs-12 col-md-6 col-lg-6 hbox-xs">
	    	<div class="hbox-column width-2">
	    		<img class="img-circle img-responsive pull-left" src="{!! asset('images/icon-user-default.png') !!}" alt="" />
	    	</div><!--end .hbox-column -->
	    	<div class="hbox-column v-top">
	    		<div class="clearfix">
	    			<div class="col-lg-12 margin-bottom-lg">
	    				<a class="text-lg text-medium" href="#">{!! $member->user->present()->prettyName !!}</a>
	    				&nbsp;
	    				<small>
	    				    <i class="fa {!! $member->user->gender == 'male'?'fa-male':'fa-female' !!} opacity-75 text-muted"></i>
	    				</small>
	    			</div>
	    		</div>
	    		<div class="clearfix opacity-75">
	    			<div class="col-md-5">
	    				<small><i class="fa fa-phone text-sm"></i> &nbsp;{{ $member->user->mobile_no ? : 'Undefined' }}</small>
	    			</div>
	    			<div class="col-lg-7 col-md-10">
	    				<small><i class="fa fa-envelope text-sm"></i> &nbsp;{!! $member->user->email !!}</small>
	    			</div>
	    		</div>
	    		<div class="clearfix opacity-75">
	    			<div class="col-md-5">
	    				<small><span><i class="fa fa-male text-sm"></i> &nbsp;{!! $member->user->present()->prettyRole !!}</span></small>
	    			</div>
	    			<div class="col-md-7">
                        <small>
                            @if( !is_null($member->user->activated_at))
                                <i class="fa fa-check text-sm text-success"></i> &nbsp;Activated
                            @else
                                <i class="fa fa-times text-sm text-danger"></i> &nbsp;Pending
                            @endif
                        </small>
	    			</div>
	    		</div>

	    		{{-- Display update and delete functions if user is head --}}
	    		@if($currentUser->isHead())
                    <div class="stick-top-right small-padding">

                        {{-- Update Household Member --}}
                        <a href="{!! route('household.member.edit', [$household->id, $member->id]) !!}"><i class="fa fa-pencil text-muted"></i></a>

                        {{-- Delete Household Member --}}
                        {!! Form::open(['route' => ['household.member.destroy', $household->id, $member->id],
                                        'method' => 'DELETE', 'class' =>
                                        'inline-block pad-left-5',
                                        'data-form-remote']) !!}
                            <button type="submit"
                                    class="link-look"
                                    data-confirm="Are you sure to deactivate member?"
                                    data-confirm-yes="Deactivate member">
                                <i class="fa fa-times text-muted"></i>
                            </button>
                        {!! Form::close() !!}
                        {{--<i class="fa fa-dot-circle-o fa-fw text-success" data-toggle="tooltip" data-placement="left" data-original-title="User online"></i>--}}
                    </div>
	    		@endif
	    	</div><!--end .hbox-column -->
	    </div><!--end .hbox-xs -->

	    @empty
	        <p class="text-center">Currently No Household Member.</p>
        @endforelse

    </div>