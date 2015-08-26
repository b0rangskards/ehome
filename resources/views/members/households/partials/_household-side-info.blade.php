<!-- BEGIN CONTACTS COMMON DETAILS -->
<div class="hbox-column col-md-4 style-default-light">
	<div class="row">
		<div class="col-xs-12">
		    <div>
		        <h4>Household Info
		            {{-- Show Edit function if current user is household head --}}
		            @if($currentUser->isHead())
                        <small class="pull-right" data-toggle="tooltip" title="Edit Household Info">
                            <a href="{!! route('household.edit', $household->id) !!}"><i class="fa fa-pencil"></i></a>
                        </small>
		            @endif
		        </h4>
		    </div>

        	<dl class="dl-horizontal dl-icon">
        		<dt><span class="fa fa-fw fa-male fa-lg opacity-50"></span></dt>
        		<dd>
        			<span class="opacity-50">Head</span><br/>
        			<span class="text-medium">{!! $householdHead->present()->prettyName !!}</span>
        		</dd>
				<dt><span class="fa fa-fw fa-mobile fa-lg opacity-50"></span></dt>
				<dd>
					<span class="opacity-50">Phone</span><br/>
					<span class="text-medium">{!! $householdHead->mobile_no?:'Undefined' !!}</span> &nbsp;<span class="opacity-50">mobile</span>
				</dd>
				<dt><span class="fa fa-fw fa-envelope-square fa-lg opacity-50"></span></dt>
				<dd>
					<span class="opacity-50">Email</span><br/>
					<a class="text-medium" href="#">{!! $householdHead->email !!}</a>
				</dd>
        	</dl><!--end .dl-horizontal -->
			<h4>Location</h4>
			<dl class="dl-horizontal dl-icon">
				<dt><span class="fa fa-fw fa-location-arrow fa-lg opacity-50"></span></dt>
				<dd>
					<span class="opacity-50">Address</span><br/>
					<span class="text-medium">
						{!! $household->present()->prettyAddress !!}
					</span>
				</dd>
				@if($household->coordinates)
				    <dd class="full-width">
				        <div id="household-side-info-map" data-coordinates="{!! $household->coordinates !!}" class="border-white border-xl height-5"></div>
				    </dd>
				    @else
				    <dd><div class="text-muted"><i>No Location Specified in map.</i></div></dd>
			    @endif
			</dl><!--end .dl-horizontal -->
		</div><!--end .col -->
	</div><!--end .row -->
</div><!--end .hbox-column -->
<!-- END CONTACTS COMMON DETAILS -->
