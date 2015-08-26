<!-- BEGIN SEARCH NAV -->
<div class="col-sm-4 col-md-3 col-lg-3">
	<ul class="nav nav-pills nav-stacked">
		<li><a href="{!! route('household.index') !!}">Household</a></li>
		<li><a href="{!! route('household.member.index', $household->id) !!}">Members
		    @if(count($householdMembers) > 0)
		        <small class="badge style-primary pull-right text-bold opacity-75">{!! count($householdMembers) !!}</small>
		    @endif
		</a></li>

        @if(count($householdMembers) > 0)
            <li class="hidden-xs"><small>Quick Contact</small></li>
            <li class="hidden-xs">
                @foreach($householdMembers as $member)
                    <a href="#">
                        <img class="img-circle img-responsive pull-left width-1" src="{!! asset('images/icon-user-default.png') !!}" alt="" />
                        <span class="text-medium">{!! $member->user->present()->prettyName !!}</span><br/>
                        <span class="opacity-50">
                            <span class="inline-block">
                                <span class="fa fa-phone text-sm"></span> &nbsp;<small>{!! $member->user->mobile_no ?:'Undefined' !!}</small>
                            </span>
                        </span>
                    </a>
                @endforeach
            </li>
		@endif

	</ul>
</div>
<!-- END SEARCH NAV -->