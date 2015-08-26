   <!-- BEGIN CARD HEADER -->
    <div class="card-head style-primary card-head-form">
            <div class="col-sm-12">
                 {{-- Task Name --}}
                 <div class="col-sm-5 form-inverse">
                    <div class="form-group floating-label {!! $errors->has('name')?'has-error':'' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
                        {!! Form::label('name', 'Task') !!}
                        <p class="help-block">{!! $errors->first('name') !!}</p>
                    </div>
                 </div>

                 <div class="pull-right">
                    <div class="form-group floating-label {!! $errors->has('priority')?'has-error':'' !!}">
                     {!! Form::label('priority', 'Priority', ['class' => 'mg-rt-20']) !!}
                    	<label class="radio-inline radio-styled radio-info" data-toggle="tooltip" title="Important">
                         	{!! Form::radio('priority', '1', true) !!}
                         </label>
                    	<label class="radio-inline radio-styled radio-danger" data-toggle="tooltip" title="Optional">
                         	{!! Form::radio('priority', '2') !!}
                         </label>
                         <p class="help-block">{!! $errors->first('priority') !!}</p>
                    </div>
                 </div>


            </div>
    </div>
    <!-- END CARD HEADER -->

	<!-- BEGIN FORM TABS -->
	<div class="card-head style-primary">
		<ul class="nav nav-tabs tabs-text-contrast tabs-accent nav-styled" data-toggle="tabs">
			<li class="active"><a href="#tab-task-details">Details</a></li>
			<li><a href="#tab-subtask">Subtask</a></li>

			{{-- Attach Image --}}
			<li class="pull-right">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div>
                        <span class="btn-file" data-toggle="tooltip" title="Attach Image">
                            <span class="fileinput-new">
                                <i class="md md-photo" style="font-size: 20px; padding:10px"></i>
                            </span>
                            <span class="fileinput-exists">
                                <i class="md md-photo" style="font-size: 20px; padding:10px"></i>
                            </span>
                            {!! Form::file('image') !!}
                        </span>
                        <a href="#" class="fileinput-exists" data-dismiss="fileinput">
                            <i class="md md-dnd-forwardslash" data-toggle="tooltip" title="Clear Image" style="font-size: 20px; padding:10px"></i>
                        </a>
                  </div>
                </div>
			</li>
			{{-- Attach Location --}}
			<li class="pull-right">
			    <span class="link" data-toggle="tooltip" title="Include Location">
			        <i class="md md-place"  data-toggle="modal" data-target="#include-location-modal" style="font-size: 20px; padding:10px"></i>
			    </span>
			    {!! Form::hidden('coordinates') !!}
			</li>
		</ul>
	</div><!--end .card-head -->
	<!-- END FORM TABS -->


	<!-- BEGIN FORM TAB PANES -->
	<div class="card-body tab-content">

        {{-- Task Details Tab --}}
		<div class="tab-pane active" id="tab-task-details">
			<div class="row">
				<div class="col-md-12">
					<div class="row">

						{{-- Due Date --}}
						<div class="col-md-5">
							<div class="form-group {!! $errors->has('due_at')?'has-error':'' !!}">
							    {!! Form::text('due_at', null, ['class' => 'form-control material-datetime']) !!}
							    {!! Form::label('due_at', 'Due Date') !!}
							    <p class="help-block">{!! $errors->first('due_at') !!}</p>
							</div>
						</div>

						<div class="col-md-2 text-center">
						    <span class="text-muted">or</span>
						</div>

						{{-- if Recurring Task Specify Date --}}
						<div class="col-md-5">
							<div class="form-group {!! $errors->has('recurring_at')?'has-error':'' !!}">
							    {!! Form::text('recurring_at', null, ['class' => 'form-control']) !!}
								<label for="recurring_at">Recurring Date
								    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
								    title="Use english phrases. Ex. everyday @2pm, every monday, mwf @7:00am ">
								    </i>
								</label>
								<p class="help-block">{!! $errors->first('recurring_at') !!}</p>
							</div>
						</div>
					</div>

					<div class="row" style="margin-top:25px;margin-bottom:20px;">
                        {{-- Task Members --}}
					    <div class="col-md-6">
                        	<div class="form-group {!! $errors->has('task_members')?'has-error':'' !!}">
                        	    <select class="form-control select2-multi" name="task_members[]" multiple="multiple">
                        	        @foreach($taskMembers as $member)
                                        <option value="{{ $member->user->id }}">{{ $member->user->firstname }}</option>
                        	        @endforeach
                        	    </select>
                            	<label for="assign">Assign To</label>
                            	<p class="help-block">{!! $errors->first('task_members') !!}</p>
                            </div>
                        </div>
					    {{-- Description --}}
						<div class="col-md-6">
                            <div class="form-group {!! $errors->has('description')?'has-error':'' !!}">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
                                {!! Form::label('description', 'Description (Optional)') !!}
                                <p class="help-block">{!! $errors->first('description') !!}</p>
                    	    </div>
                    	</div>
					</div>

					<div class="row">
                        <div class="col-md-12">
                            <p class="hint pd-lt-20">Note: You have to choose either a task has Due Date or Recurring </p>
                        </div>
					</div>
				</div>

			</div>
		</div>

        {{-- Subtask Tab Content --}}
		<div class="tab-pane" id="tab-subtask">

            <ul class="list-unstyled" id="subtaskList"></ul>
		    <div class="form-group">
		        {{-- Add Subtask Button --}}
		    	<a class="btn btn-flat btn-default pull-right" data-duplicate="subtaskTmpl" data-target="#subtaskList">
		    	    <span class="text-muted"><i class="md md-add"></i>&nbsp;Add Subtask</span>
		    	</a>
		    </div>
		    {{-- This is a Note --}}
		    <div class="row">
                <div class="col-md-12">
                    <p class="hint pd-lt-20">Note: Subtask is Optional.<br>If Subtask Assignment left empty, It will assign to all members of main task.</p>
                </div>
            </div>
		</div>

	</div>
	<!-- END FORM TAB PANES -->
