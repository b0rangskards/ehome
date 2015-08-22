@extends('layouts.master-member')
@section('content')
<div class="card">

	<div class="card-head style-primary">
		<header>Update your Household Info</header>
	</div>

    {!! Form::open(['route' => ['household.update', $household->id], 'method' => 'PUT']) !!}
    <div class="card-body style-primary form-inverse">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group floating-label {!! $errors->has('address')?'has-error':'' !!}">
                            {!! Form::text('address', $household->address, ['class' => 'form-control input-lg']) !!}
                            {!! Form::label('address', 'Address') !!}
                            <p class="help-block">{!! $errors->first('address') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group {!! $errors->has('coordinates')?'has-error':'' !!}">
            <div class="col-md-12">
                <h4>Please Select the Location</h4>
            </div>
            <div class="row center-block" data-coordinates="{!! $household->coordinates !!}" id="update-household-map">
            </div>
            {!! Form::hidden('coordinates', $household->coordinates) !!}
            <p class="inline-block pull-left">{!! $errors->first('coordinates') !!}</p>
        </div>
        <p class="opacity-50 pull-right">Note: Drag the marker to your household location.</p>
    </div>

    <!-- BEGIN FORM FOOTER -->
    <div class="card-actionbar">
    	<div class="card-actionbar-row">
    		<a class="btn btn-flat btn-lg" href="{!! route('home') !!}">CANCEL</a>
    		{!! Form::submit('UPDATE', [
    		'class' => 'btn ink-reaction btn-raised btn-primary btn-lg btn-loading-state',
    		'data-loading-text' => "<i class='fa fa-spinner fa-spin'></i>Please wait"
    		]) !!}
    	</div><!--end .card-actionbar-row -->
    </div><!--end .card-actionbar -->
    <!-- END FORM FOOTER -->

    {!! Form::close() !!}

</div>
@stop

