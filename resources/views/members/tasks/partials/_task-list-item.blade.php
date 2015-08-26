<li>
    <div class="card">
        <div class="comment-avatar opacity-50">
            @if($task->isDone())
                <i class="fa fa-check flat-green"></i>
            @elseif($task->isPending())
                <i class="fa fa-hourglass-start flat-orange"></i>
            @else
                <i class="fa fa-hourglass-half flat-turq"></i>
            @endif
        </div>
        <div class="card-body">
            <a href="{{route('task.show', $task->id)}}">
        	    <h4 class="comment-title">{{str_limit($task->present()->prettyName, 40)}}
        	        <span class="stick-top-right small-padding {{$task->isImportant()?'flat-green':'flat-orange'}}" data-toggle="tooltip" title="{{$task->isImportant()?'Important':'Optional'}}"><i class="fa fa-circle"></i></span>
        	        <small class="stick-top-right small-padding {{$task->hasExpired()?'flat-red':'flat-green'}}" style="margin-right: 30px;">{{$task->hasExpired()?'Expired':'Expires'}} {{Carbon::parse($task->due_at)->diffForHumans()}}</small>
        	    </h4>
        	</a>

        	<span class="stick-bottom-right small-padding">
           	    @if($currentUser->isHead())
                        <a href="{{route('task.edit', $task->id)}}" class="link-look text-default-light mg-rt-5" data-toggle="tooltip" data-title="Update Task?">
                            <i class="fa fa-pencil"></i>
                        </a>

                   {!! Form::open(['class' => 'inline-block mg-rt-5', 'route' => ['task.destroy', $task->id], 'method' => 'DELETE', 'data-form-remote']) !!}
                       <button type="submit" class="link-look text-default-light"
                       data-toggle="tooltip" data-title="Cancel Task?"
                       data-confirm="Do you want to cancel task?">
                           <i class="fa fa-trash"></i>
                       </button>
                   {!! Form::close() !!}
                @endif

        	    <span class="{{$task->isPending()?'flat-orange':'flat-green'}}">Status: {{$task->present()->prettyStatus}}</span>
        	</span>


        	<p>{{$task->present()->prettyDescription}}</p>
        </div>
    </div>
</li>