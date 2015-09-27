		   <div class="nine columns omega register">
               <div class="text_input">
                    <div class="text_input_body">

                        <div class="headtext_style text-center">Sign up now. Its FREE!</div>
                        <p class="subtext_style text-center">Free trial for 1 month.</p>


                    {!! Form::open(['route' => 'auth.register', 'id' => 'registration_form']) !!}

                    @include('flash::message')

                        <div class="contact_st">
                            <div class="contact_form">

                                    <div class="col-xs-5">
                                        <div class="form-group {!! $errors->has('firstname')?'has-error':'' !!}"
                                        data-tooltip-validation
                                        data-toggle="tooltip"
                                        title="{!! $errors->first('firstname') !!}">
                                            {!! Form::text('firstname', null ,[
                                                'class'       => 'form-control',
                                                'placeholder' => 'Firstname'
                                            ]) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-5">
                                        <div class="form-group {!! $errors->has('lastname')?'has-error':'' !!}"
                                        data-tooltip-validation
                                        data-toggle="tooltip"
                                        title="{!! $errors->first('lastname') !!}">
                                            {!! Form::text('lastname', null ,[
                                                'class'       => 'form-control',
                                                'placeholder' => 'Lastname'
                                            ]) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-2">
                                        <div class="form-group {!! $errors->has('middleinitial')?'has-error':'' !!}"
                                        data-tooltip-validation
                                        data-toggle="tooltip"
                                        title="{!! $errors->first('middleinitial') !!}">
                                            {!! Form::text('middleinitial', null ,[
                                                'maxlength'   => '1',
                                                'class'       => 'form-control',
                                                'placeholder' => 'MI'
                                            ]) !!}
                                        </div>
                                    </div>


                                    <div class="col-xs-5">
                                        <div class="form-group {!! $errors->has('gender')?'has-error':'' !!}"
                                        data-tooltip-validation
                                        data-toggle="tooltip"
                                        title="{!! $errors->first('gender') !!}">
                                            {!! Form::radio('gender', 'male') !!} Male
                                            {!! Form::radio('gender', 'female') !!} Female
                                        </div>
                                    </div>

                                    <div class="col-xs-7">
                                        <div class="form-group {!! $errors->has('mobile_no')?'has-error':'' !!}"
                                        data-tooltip-validation
                                        data-toggle="tooltip"
                                        title="{!! $errors->first('mobile_no') !!}">
                                            {!! Form::text('mobile_no', null ,[
                                                'class'       => 'form-control mobile_no',
                                                'placeholder' => 'Mobile Number'
                                            ]) !!}
                                        </div>
                                    </div>


                                <div class="col-xs-12">
                                   <div class="form-group {!! $errors->has('email')?'has-error':'' !!}"
                                   data-tooltip-validation
                                   data-toggle="tooltip"
                                   title="{!! $errors->first('email') !!}">
                                        {!! Form::email('email', null ,[
                                            'class'       => 'form-control',
                                            'placeholder' => 'Email'
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {!! Form::button('Sign Up Now', [
                                            'type'  => 'submit',
                                            'id'    => 'subscribe_btn_11',
                                            'class' => 'subscribe_btn'
                                        ]) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                       {!! Form::close() !!}
                    </div>
           	</div>
           </div>