@extends('layouts.master-member')

@section('content')

@if($currentUser->isHead())
    <div class="row">
        {{-- all md-3 --}}
        @include('members.widgets._completed-task', ['completedTasksCount' => $currentUser->completedTasks()->count()])

        @include('members.widgets._pending-task', ['pendingTasksCount' => $currentUser->pendingTasks()->count()])

        @include('members.widgets._new-task-actions', ['taskActionsCount' => $currentUser->taskActions()->count()])

        @if(!$currentUser->subscription->isExpired())
            @include('members.widgets._subscription-time-left', ['timeLeft' => $currentUser->subscription->present()->timeLeft])
        @else
            @include('members.widgets._subscription-extend', ['user' => $currentUser]);
        @endif
    </div><!--end .row -->

    <div class="row">

        <div class="col-md-3 col-sm-6">
                <a href="{{route('task.create')}}" class="btn ink-reaction btn-raised btn-lg btn-primary">Create Task</a>
        </div><!--end .col -->

    </div>
@endif

@if($currentUser->isMember())
    <div class="row">
        {{-- md-4 --}}
        @include('members.widgets._new-task')
        {{-- md-3 --}}
        @include('members.widgets._todos-task')
    </div>
@endif

@stop