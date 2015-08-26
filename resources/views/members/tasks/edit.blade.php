@extends('members.partials._task-master')
@section('card-content')

@include('members.households.partials._include-location-modal')

{!! Form::model($task , ['route' => ['task.update', $task->id], 'method' => 'PUT', 'files' => true]) !!}

    @include('members.tasks.partials._task-form')

	<!-- BEGIN FORM FOOTER -->
	<div class="card-actionbar">
		<div class="card-actionbar-row text-muted">
			{!! HTML::link('#', 'Cancel', ['class' => 'btn btn-flat weight600']) !!}
			{!! Form::button('Update Task', ['type' => 'submit', 'class' => 'btn btn-flat weight600']) !!}
		</div>
	</div>
	<!-- END FORM FOOTER -->

{!! Form::close() !!}

{{-- Add Subtask Template--}}
@include('members.tasks.partials._add-subtask-tmpl')

@stop

