@extends('layouts.master-member')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-head style-primary">
               <header>Edit Your Profile</header>
            </div>
            {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT']) !!}
                <div class="card-body style-primary form-inverse">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group {{$errors->has('firstname')?'has-error':''}}">
                                    {!! Form::label('firstname', 'Firstname') !!}
                                    {!! Form::text('firstname', null, [
                                        'class' => 'form-control input-lg'
                                        ]) !!}
                                    <span class="help-block">{{ $errors->first('firstname') }}</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group {{$errors->has('lastname')?'has-error':''}}">
                                    {!! Form::label('lastname', 'Lastname') !!}
                                    {!! Form::text('lastname', null, [
                                        'class' => 'form-control input-lg'
                                        ]) !!}
                                    <span class="help-block">{{ $errors->first('lastname') }}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{$errors->has('middleinitial')?'has-error':''}}">
                                    {!! Form::label('middleinitial', 'MI') !!}
                                    {!! Form::text('middleinitial', null, [
                                        'class' => 'form-control input-lg',
                                        'maxlength' => '1'
                                        ]) !!}
                                    <span class="help-block">{{ $errors->first('middleinitial') }}</span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::label('gender', 'Gender') !!}
                            <div class="form-group {!! $errors->has('gender')?'has-error':'' !!}">
                            	<label class="radio-inline radio-styled">
                            		{!! Form::radio('gender', 'male') !!}<span>Male</span>
                            	</label>
                            	<label class="radio-inline radio-styled">
                            		{!! Form::radio('gender', 'female') !!}<span>Female</span>
                            	</label>
                            	<span class="help-block">{{$errors->first('gender')}}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            {!! Form::label('mobile_no', 'Mobile No.') !!}
                            <div class="form-group {!! $errors->has('mobile_no')?'has-error':'' !!}">
                                {!! Form::text('mobile_no', null ,[
                                    'class'       => 'form-control mobile_no',
                                    'placeholder' => 'ex. +63923445126'
                                ]) !!}
                                <span class="help-block">{{$errors->first('mobile_no')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('email', 'Email') !!}
                            <div class="form-group {!! $errors->has('email')?'has-error':'' !!}">
                                 {!! Form::email('email', null ,['class' => 'form-control']) !!}
                                 <span class="help-block">{{$errors->first('email')}}</span>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="card-actionbar">
                    <div class="card-actionbar-row">
                        {!! Form::submit('Save', ['class' => 'btn btn-flat btn-primary ink-reaction']) !!}
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop