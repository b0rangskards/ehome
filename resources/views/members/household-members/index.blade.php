@extends('members.partials._household-master')
@section('card-body')

<div class="row">
    <!-- BEGIN SEARCH RESULTS LIST -->
    <div class="margin-bottom-xxl">
        <span class="text-light text-lg">Household Members </span>
    	<div class="btn-group btn-group-sm pull-right">
    		<button type="button" class="btn btn-default-light dropdown-toggle" data-toggle="dropdown">
    			<span class="fa fa-arrow-down"></span> Sort
    		</button>
    		<ul class="dropdown-menu dropdown-menu-right animation-dock" role="menu">
    			<li><a href="#">First name</a></li>
    			<li><a href="#">Last name</a></li>
    			<li><a href="#">Email address</a></li>
    		</ul>
    	</div>
    </div>

    @include('members.households.partials._members')

</div>


@stop