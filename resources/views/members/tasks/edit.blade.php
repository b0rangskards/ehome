@extends('members.partials._task-master')
@section('card-content')

@include('members.households.partials._include-location-modal')

{!! Form::model($task , ['route' => ['task.update', $task->id], 'method' => 'PUT', 'files' => true]) !!}

    @include('members.tasks.partials._task-form', ['submitButtonText' => 'Update Task'])

{!! Form::close() !!}

@stop

