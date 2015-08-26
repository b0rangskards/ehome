@extends('layouts.master-member')
@section('content')
<div class="row">
    {{-- Flash Messages --}}
    @include('flash::message')
    {{-- Task Navigation --}}
    @include('members.partials._task-nav')

<div class="row">
    <div class="col-sm-7 col-md-offset-1">
        <h4>You have {{count($tasks)}} {{str_plural('Task', count($tasks))}}</h4>
        <ul class="list-comments">
            @forelse($tasks as $task)
                @include('members.tasks.partials._task-list-item')
            @empty
                <p class="text-center text-default-light">You have no tasks yet.</p>
            @endforelse
        </ul>

        <div class="text-center">
        {!! $tasks->render() !!}
        </div>
    </div>
</div>


</div>
@stop