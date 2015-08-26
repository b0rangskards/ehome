    <div class="list-results">

        @forelse($householdMembers as $member)

            <div class="col-xs-12 col-md-10 col-lg-10 hbox-xs">
                <div class="hbox-column width-2">
                    <img class="img-circle img-responsive pull-left" src="{!! asset('images/icon-user-default.png') !!}" alt="" />
                </div><!--end .hbox-column -->
                <div class="hbox-column v-top">
                    <div class="clearfix">
                        <div class="col-lg-12 margin-bottom-lg">
                            <a class="text-medium" href="#">{!! $member->user->present()->prettyName !!}</a>
                            &nbsp;
                            <small>
                                <i class="fa {!! $member->user->gender == 'male'?'fa-male':'fa-female' !!} opacity-75 text-muted"></i>
                                @if( !is_null($member->user->activated_at))
                                    <i class="fa fa-check text-sm text-success" data-toggle="tooltip" title="Activated"></i>
                                @else
                                        <i class="fa fa-times text-sm text-danger" data-toggle="tooltip" title="Pending"></i>
                                @endif
                            </small>
                    </div>
                    </div>
                    <div class="clearfix opacity-75">
                        <div class="col-md-12">
                            <small><i class="fa fa-phone text-sm"></i> &nbsp;{{ $member->user->mobile_no ? : 'Undefined' }}</small>
                        </div>

                    </div>
                    <div class="clearfix opacity-75">
                        <div class="col-lg-12 col-md-12">
                            <small><i class="fa fa-envelope text-sm"></i> &nbsp;{!! $member->user->email !!}</small>
                        </div>
                    </div>
                    <div class="clearfix opacity-75">
                        <div class="col-lg-12 col-md-12">
                            <i class="fa fa-male text-sm"></i> &nbsp;{!! $member->user->present()->prettyRole !!}
                        </div>
                    </div>
                    <div class="stick-top-right small-padding">
                        <i class="fa fa-dot-circle-o fa-fw text-success" data-toggle="tooltip" data-placement="left" data-original-title="User online"></i>
                    </div>
                </div><!--end .hbox-column -->
            </div><!--end .hbox-xs -->

	    @empty
	        <p class="text-center" style="margin-top: 100px">Currently No Household Member.</p>
        @endforelse

    </div>