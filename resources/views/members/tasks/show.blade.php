@extends('layouts.master-member')
@section('content')

@include('members.tasks.partials._view-image')

<div class="row">
    {{-- Flash Messages --}}
    @include('flash::message')

    {{-- Task Navigation --}}
    @include('members.partials._task-nav')

    <div class="col-sm-7 col-md-offset-1">
        <div class="card">
            <div class="card-head">
                <header>{!!wordwrap($task->present()->prettyName, 40, "<br />\n", true)!!}</header>

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
                <div class="col-md-12">

                    <div class="col-md-8">
                        <em>{{$task->present()->prettyDescription}}</em>

                        @if($task->coordinates)
                            <div class="img-rounded col-md-12 height-5 map-with-coords" data-coordinates="{{$task->coordinates}}" style="margin-top:20px"></div>
                        @else
                            <div class="col-md-12">
                                <p class="text-center">No Location Specified.</p>
                            </div>
                        @endif

                    </div>

                    <div class="col-md-4">
                        @if(!$task->hasExpired() && $task->hasMember($currentUser->id))
                            <div class="row text-center">
                                {{-- Update Task Progress Form --}}
                                {!! Form::open(['route' => ['task.update.status', $task->id], 'method' => 'PATCH']) !!}
                                <p class="text-muted">Current Status: <span class="current-status-content {{$task->status=='pending'?'text-warning':'text-success'}}">{{$task->present()->prettyStatus}}</span></p>

                                {{-- Show updating of task status if task is not done --}}
                                @if(!$task->isDone())
                                    <p class="text-lg text-default-light status-label">Update Status?<br>
                                        @if($task->isPending())
                                            <button data-userid="{{$currentUser->id}}" type="button" data-status="almost_there"
                                            class="btn ink-reaction btn-floation-action btn-default-light btn-update-task-status"
                                            data-toggle="tooltip" data-placement="left" title="Almost There">
                                                <i class="fa fa-hand-stop-o"></i>
                                            </button>
                                        @endif
                                        @if($task->isPending() || $task->isAlmostDone())
                                            <button data-userid="{{$currentUser->id}}" type="button" data-status="done"
                                            class="btn ink-reaction btn-floation-action btn-primary btn-update-task-status"
                                            data-toggle="tooltip" data-placement="right" title="I'm Done">
                                                <i class="fa fa-thumbs-o-up"></i>
                                            </button>
                                        @endif
                                        <span class="ui active small inline loader" style="display:none;margin-left: 10px"></span>
                                    </p>
                                @endif
                                {!! Form::close() !!}
                            </div>
                        @endif
                        @if($task->image)
                            <div class="row text-center ">
                                 <hr/>
                                 <p class="text-xl text-default-light"><i class="md md-photo"></i><br/>
                                     <a href="" data-toggle="modal" data-target="#view-task-image-modal">
                                        <img src="{{$task->getImageUrl()}}" class="height-2 img-rounded" alt=""/>
                                     </a>
                                 </p>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

            @if(!$task->hasExpired() && $task->hasMemberOrHead($currentUser->id))
                <div class="card-actionbar">
                    <em class="text-default-light pull-right" style="margin-right:20px">Task sent by {{$task->household->head->present()->prettyName}}</em>

                    @if(!$task->isDone())
                        {{-- Leave a note --}}
                        {!! Form::open(['route' => ['task.add-note', $task->id], 'class' => 'form-task-leave-note']) !!}
                            <div class="col-md-12">
                                <div class="form-group floating-label">
                                {!! Form::hidden('user_id', $currentUser->id) !!}
                                {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2]) !!}
                                <span class="help-block"></span>
                                {!! Form::label('note', 'Leave a note') !!}
                                {!! Form::submit('Send', ['class' => 'pull-right btn btn-flat btn-primary ink-reaction']) !!}
                                <span class="ui active small inline loader pull-right" style="display:none;margin-top: 5px;"></span>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            @endif
        </div> {{-- End of Card --}}

        <div class="row">
            <div class="col-md-12">
                <h4>{{count($taskNotes)}} {{str_plural('Note', count($taskNotes))}}</h4>
                <ul class="list-comments" id="list-tasknote">
                    @forelse($taskNotes as $note)
                        <li data-id="{{$note->id}}">
                            <div class="card">
                                <div class="comment-avatar"><i class="fa fa-comment opacity-50"></i></div>
                                <div class="card-body">
                                	<h4 class="comment-title">{{$note->owner->present()->prettyName}} <small>{{$note->created_at->diffForHumans()}}</small></h4>
                                	<p>{{$note->note}}</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li id="no-notes-item">
                            <p class="text-center">Currently no notes.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>

@include('members.tasks.partials._note-item-tmpl')

@stop