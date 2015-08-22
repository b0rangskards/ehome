@extends('members.partials._task-master')
@section('card-content')

{{--
    - task details (includes task types and sub task)
    - task members
    - additional task notes if any
--}}

{{--@include('layouts.partials.errors')--}}

{!! Form::open(['route' => 'task.store', 'files' => true]) !!}
    <!-- BEGIN CARD HEADER -->
    <div class="card-head style-primary card-head-form form-inverse">
            <div class="col-sm-12">
                 {{-- Task Name --}}
                 <div class="col-sm-5">
                    <div class="form-group floating-label {!! $errors->has('name')?'has-error':'' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
                        {!! Form::label('name', 'Task') !!}
                        <p class="help-block">{!! $errors->first('name') !!}</p>
                    </div>
                 </div>
                 {{-- Task Type --}}
                 <div class="col-sm-3 col-offset-4 pull-right">
                     <div class="form-group floating-label {!! $errors->has('type')?'has-error':'' !!}">
                        {!! Form::select('type', $taskTypes, null, ['class' => 'form-control input-lg']) !!}
                        {!! Form::label('type', 'Type') !!}
                        <p class="help-block">{!! $errors->first('type') !!}</p>
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
			<li><a href="#tab-additional-details">Additional Details</a></li>
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
						<div class="col-md-6">
							<div class="form-group {!! $errors->has('due_date')?'has-error':'' !!}">
							    {!! Form::text('due_date', null, ['class' => 'form-control material-datetime']) !!}
							    {!! Form::label('due_date', 'Due Date') !!}
							    <p class="help-block">{!! $errors->first('due_date') !!}</p>
							</div>
						</div>

						{{-- if Recurring Task Specify Date --}}
						<div class="col-md-6">
							<div class="form-group {!! $errors->has('recurring_date')?'has-error':'' !!}">
							    {!! Form::text('recurring_date', null, ['class' => 'form-control']) !!}
								<label for="recurring_date">Recurring Date
								    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
								    title="Use english phrases. Ex. everyday @2pm, every monday, mwf @7:00am ">
								    </i>
								</label>
								<p class="help-block">{!! $errors->first('recurring_date') !!}</p>
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

                        {{-- Priority --}}
						<div class="col-md-6">
							<div class="form-group {!! $errors->has('priority')?'has-error':'' !!}">
                            {!! Form::label('priority', 'Priority', ['class' => 'mg-rt-20']) !!}
								<label class="radio-inline radio-styled radio-primary" data-toggle="tooltip" title="Important">
								    {!! Form::radio('priority', '1') !!}
                                </label>
								<label class="radio-inline radio-styled radio-success" data-toggle="tooltip" title="Normal">
                                	{!! Form::radio('priority', '2') !!}
                                </label>
								<label class="radio-inline radio-styled radio-warning" data-toggle="tooltip" title="Optional">
                                	{!! Form::radio('priority', '3') !!}
                                </label>
                                <p class="help-block">{!! $errors->first('priority') !!}</p>
							</div>
						</div>
					</div>

                    {{-- Description --}}
					<div class="row">
						<div class="col-md-12">
                            <div class="form-group {!! $errors->has('description')?'has-error':'' !!}">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) !!}
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
		    	<a class="btn btn-flat btn-default" data-duplicate="subtaskTmpl" data-target="#subtaskList">
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

		{{-- Additional Details Tab Content --}}
		<div class="tab-pane" id="tab-additional-details">
		    <div class="col-sm-8">
		        <div class="row">

                    {{-- Upload Image --}}
                    <div class="col-md-8">
                        <div class="form-group {!! $errors->has('image')?'has-error':'' !!}">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div>
                                    <label class="text-muted">Upload Image (Optional)</label>
                                    <span class="btn btn-default btn-file" style="margin-bottom: 5px;margin-left:5px;">
                                        <span class="fileinput-new">
                                            <i class="fa fa-paperclip text-muted"></i>
                                        </span>
                                        <span class="fileinput-exists">
                                            <i class="fa fa-paperclip text-muted"></i>
                                        </span>
                                        {!! Form::file('image') !!}
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                        <i class="fa fa-times text-muted"></i>
                                    </a>
                                    <div class="fileinput-preview thumbnail inline-block" data-trigger="fileinput" style="width: 150px; height: 120px;"></div>
                              </div>
                            </div>
                            <p class="help-block">{!! $errors->first('image') !!}</p>
                        </div>
                    </div>
		        </div>

		        {{-- This is a Note --}}
		        <div class="row">
		            <div class="form-group floating-label mg-tp-20 {!! $errors->has('notes')?'has-error':'' !!}">
                        <textarea name="notes" class="form-control control-2-rows"  rows="2"></textarea>
                        <label for="notes">Notes (Optional)</label>
                        <p class="help-block">{!! $errors->first('notes') !!}</p>
                    </div>
		        </div>
		    </div>

		    {{-- Task Map --}}
		    <div class="col-md-4">
            	<div class="form-group {!! $errors->has('coordinates')?'has-error':'' !!}">
            	     <label for="notes">Location of the task? (Optional)</label>
            		<div id="create-task-map" class="height-7"></div>
            	    {!! Form::hidden('coordinates') !!}
            	    <p class="help-block">{!! $errors->first('coordinates') !!}</p>
            	</div>
            </div>

		</div>

	</div>
	<!-- END FORM TAB PANES -->

	<!-- BEGIN FORM FOOTER -->
	<div class="card-actionbar">
		<div class="card-actionbar-row text-muted">
			{!! HTML::link('#', 'Cancel', ['class' => 'btn btn-flat weight600']) !!}
			{!! Form::button('Create Task', ['type' => 'submit', 'class' => 'btn btn-flat weight600']) !!}
		</div>
	</div>
	<!-- END FORM FOOTER -->

{!! Form::close() !!}

{{-- Add Subtask Template--}}
@include('members.tasks.partials._add-subtask-tmpl')

@stop

