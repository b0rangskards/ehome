@extends('layouts.master-member')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-head style-primary">
               <header>User Settings</header>
            </div>

            <div class="card-body">

                <div class="row small-padding">
                    <div class="form-group">
                        <div class="col-md-3">
                            <span class="text-md text-bold">Remind before task expires (minutes)</span>
                        </div>
                           <div class="col-md-9">
                                <label class="radio-inline radio-styled">
                                    <input type="radio" name="inlineRadioOptions" value="option1"><span>15</span>
                                </label>
                                <label class="radio-inline radio-styled">
                                    <input type="radio" name="inlineRadioOptions" value="option2"><span>30</span>
                                </label>
                                <label class="radio-inline radio-styled">
                                    <input type="radio" name="inlineRadioOptions" value="option3"><span>60</span>
                                </label>
                           </div>
                    </div>
                </div>


                <div class="row small-padding">
                    <div class="form-group">
                        <div class="col-md-3">
                            <span class="text-md text-bold">Receive SMS?</span>
                        </div>
                        <div class="col-md-4">
                            <label class="checkbox-inline checkbox-styled checkbox-primary">
                    	    	<input type="checkbox" value="receive_sms" checked="">
                    	    </label>
                        </div>
                    </div>
                </div>

                <div class="row small-padding" >
                    <div class="col-md-3">
                    {!! Form::open(['route' => ['profile.deactivate', $currentUser->id], 'method' => 'DELETE']) !!}
                        {!!Form::submit('Deactivate Account?', ['class' => 'link-look text-danger text-bold'])!!}
                    {!! Form::close() !!}
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>

@stop