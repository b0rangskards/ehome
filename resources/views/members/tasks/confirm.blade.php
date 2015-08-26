@extends('layouts.master-member')
@section('content')

<div class="row">

    {{-- Flash Messages --}}
    @include('flash::message')

    {{-- Task Navigation --}}
    @include('members.partials._task-nav')

    <div class="col-sm-7 col-md-offset-1">

        {{-- Task Content --}}
        <div class="card">
		    <div class="card-head">
                <header>{!!wordwrap($task->present()->prettyName, 45, "<br />\n", true)!!}</header>
                <span class="text-default-light pull-right" style="margin-right: 20px;"><small>Expires </small>{{$task->present()->informalDeadline}}</span>
                @if($task->priority == 1)
                    <div class="pull-right">
                    	<i class="fa fa-dot-circle-o fa-fw text-success" data-toggle="tooltip" data-placement="left" data-original-title="Important"></i>
                    </div>
                @else
                    <div class="pull-right">
                    	<i class="fa fa-dot-circle-o fa-fw text-accent-bright" data-toggle="tooltip" data-placement="left" data-original-title="Optional"></i>
                    </div>
                @endif
		    </div>

            <div class="card-body text-default-light">
                @if($task->description)
                    <p class="text-muted">{{$task->present()->prettyDescription}}</p>
                @endif
                @if($task->coordinates)
                    <div class="col-md-8 col-md-offset-2 img-rounded height-6 map-with-coords" data-coordinates="{{$task->coordinates}}"></div>
                @endif
            </div>

            @if($task->hasExpired() && is_null($task->getMember($currentUser->id)->pivot->accepted))
                <div class="card-actionbar text-center">
                    <p class="text-xl text-default-light"><i class="fa fa-exclamation-circle"></i>&nbsp;The Task expired {{$task->present()->informalDeadline}}.</p>
                    <a class="btn btn-block ink-reaction btn-primary-light" href="{{route('task.index')}}">Click here to continue.</a>
                </div>
            @else
                {!! Form::open(['route' => ['task.confirm', $task->id], 'method' => 'PATCH', 'id' => 'form-task-confirm']) !!}
                    {!! Form::hidden('user_id', $currentUser->id) !!}
                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <button type="button" data-task-confirm="accept" class="btn btn-block ink-reaction btn-primary-light">Accept Task</button>
                            <button type="button" data-task-confirm="decline" class="btn btn-block ink-reaction btn-danger">Decline</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endif

        </div>
    </div>

</div>
@stop