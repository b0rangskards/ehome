@extends('members.partials._task-master')
@section('card-content')

{{--
    - task details (includes sub task)
    - task members
    - additional task notes if any
--}}

{{--@include('layouts.partials.errors')--}}
@include('members.households.partials._include-location-modal')

{!! Form::open(['route' => 'task.store', 'files' => true]) !!}

    @include('members.tasks.partials._task-form', ['submitButtonText' => 'Create Task'])

{!! Form::close() !!}

{{-- Add Subtask Template--}}
@include('members.tasks.partials._add-subtask-tmpl')

@stop

