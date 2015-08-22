<!-- BEGIN SEARCH NAV -->
<div class="col-sm-3">

    <div class="nav-action">

        <h4 class="inline-block">Task</h4>

        <span class="action-btn-right">
            {{-- Create Task --}}
            @if($currentUser->isHead())
                <a href="{{ route('task.create') }}" data-toggle="tooltip" title="New Task">
                    <i class="md md-add"></i>
                </a>
            @endif
        </span>

        <hr/>

    </div>

	<ul class="nav nav-pills nav-stacked nav-transparent nav-no-border">
	    {{-- Messages and Notes --}}
		{{--<li class="text-muted">--}}
		    {{--<a href="#"><i class="fa fa-sticky-note-o"></i>&nbsp;&nbsp;Notes--}}
		        {{--<small class="badge style-primary pull-right text-bold opacity-75">3</small>--}}
		    {{--</a>--}}
		{{--</li>--}}
		<li class="text-muted">
		    <a href="#"><i class="md md-forward"></i>&nbsp;Actions
		        <small class="badge style-primary pull-right text-bold opacity-75">1</small>
		    </a>
		</li>
		<li class="text-muted">
            <a href="#"><i class="md md-check"></i>&nbsp;Completed
                <small class="badge style-primary pull-right text-bold opacity-75">1</small>
            </a>
        </li>
	</ul>

    <hr/>

	<ul class="nav nav-tabs nav tabs-center nav-styled" data-toggle="tabs">
		<li class="active"><a href="#tab-pending">Pending</a></li>
		<li><a href="#tab-types">Types</a></li>
		<li><a href="#tab-filters">Filters</a></li>
	</ul>
	<div class="tab-content tab-styled">
	    <div class="tab-pane" id="tab-pending">
	        <p>Pending Task</p>
	    </div>
	    <div class="tab-pane" id="tab-types">
            <p>Task Types</p>
        </div>
	    <div class="tab-pane" id="tab-filters">
            <p>Filters</p>
        </div>
	</div>


</div>
<!-- END SEARCH NAV -->