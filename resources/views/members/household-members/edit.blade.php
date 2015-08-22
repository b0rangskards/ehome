@extends('members.partials._household-master')
@section('card-body')
{!! Form::open(['route' => ['household.member.update',$member->household_id, $member->id], 'method' => 'PUT']) !!}

    <div class="card">

	<div class="card-head">
		<header>Update Household Member</header>
	</div>

    <div class="card-body floating-label">

        {{-- Gender --}}
        <div class="row center-block">
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('gender')?'has-error':'' !!}" style="margin-top:20px;">
                    <div>
                        <label class="radio-inline radio-styled">
                            {!! Form::radio('gender', 'male', $member->user->gender=='male'?:null) !!}<span>Male</span>
                        </label>
                        <label class="radio-inline radio-styled">
                            {!! Form::radio('gender', 'female', $member->user->gender=='female'?:null) !!}<span>Female</span>
                        </label>
                    </div>
                    <p class="help-block">{!! $errors->first('gender') !!}</p>
                </div>
            </div>
        </div>

        <div class="row center-block">
            {{-- Firstname --}}
            <div class="col-md-5">
                <div class="form-group {!! $errors->has('firstname')?'has-error':'' !!}">
                    {!! Form::text('firstname', $member->user->firstname, ['class' => 'form-control']) !!}
                    {!! Form::label('firstname', 'Firstname') !!}
                    <p class="help-block">{!! $errors->first('firstname') !!}</p>
                </div>
            </div>
            {{-- Lastname --}}
            <div class="col-md-5">
                <div class="form-group {!! $errors->has('lastname')?'has-error':'' !!}">
                    {!! Form::text('lastname', $member->user->lastname, ['class' => 'form-control']) !!}
                    {!! Form::label('lastname', 'Lastname') !!}
                    <p class="help-block">{!! $errors->first('lastname') !!}</p>
                </div>
            </div>
            {{-- Middleinitial --}}
            <div class="col-md-2">
                <div class="form-group {!! $errors->has('middleinitial')?'has-error':'' !!}">
                    {!! Form::text('middleinitial', $member->user->middleinitial, ['class' => 'form-control', 'maxlength' => 1]) !!}
                    {!! Form::label('middleinitial', 'MI') !!}
                    <p class="help-block">{!! $errors->first('middleinitial') !!}</p>
                </div>
            </div>
        </div>
        <div class="row center-block">
            {{-- Email --}}
            <div class="col-md-5">
                <div class="form-group {!! $errors->has('email')?'has-error':'' !!}">
                    {!! Form::text('email', $member->user->email, ['class' => 'form-control']) !!}
                    {!! Form::label('email', 'Email') !!}
                    <p class="help-block">{!! $errors->first('email') !!}</p>
                </div>
            </div>
            {{-- Mobile No --}}
            <div class="col-md-7">
                <div class="form-group {!! $errors->has('mobile_no')?'has-error':'' !!}">
                    {!! Form::text('mobile_no', $member->user->mobile_no, ['class' => 'form-control mobile_no']) !!}
                    {!! Form::label('mobile_no', 'Mobile No.') !!}
                    <p class="help-block">{!! $errors->first('mobile_no') !!}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN FORM FOOTER -->
    <div class="card-actionbar">
    	<div class="card-actionbar-row">
    		{!! Form::button('Save', [
    		'type'  => 'submit',
    		'class' => 'btn btn-flat btn-primary ink-reaction'
    		]) !!}
    	</div>
    </div>
    <!-- END FORM FOOTER -->

    </div>
{!! Form::close() !!}
<p class="text-caption"><i>Note: Account activation will be sent thru the email you've entered.</i></p>
@stop

