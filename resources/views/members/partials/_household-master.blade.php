@extends('layouts.master-member')
@section('content')
<div class="card">

    <!-- BEGIN SEARCH HEADER -->
    <div class="card-head style-primary">
    	<div class="tools pull-left">
    		{{-- Search Field --}}
    		<form class="navbar-search" role="search">
    			<div class="form-group">
    				<input type="text" class="form-control" name="contactSearch" placeholder="Enter your keyword">
    			</div>
    			<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
    		</form>
    	</div>
    	{{-- Display Add Member Button if current user is household head --}}
    	@if($currentUser->isHead())
            {{-- Add button --}}
            <div class="tools">
                <a class="btn btn-floating-action btn-default-light" href="{!! route('household.member.create', $currentUser->household->id) !!}" data-toggle="tooltip" data-placement="left" title="New Member">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
    	@endif
    </div>
    <!-- END SEARCH HEADER -->


    <div class="card-body">
        <div class="row">

        @include('flash::message')

        @include('members.partials._household-nav')

        <div class="col-md-9">
            @yield('card-body')
        </div>

        </div>
    </div>


</div>
@stop