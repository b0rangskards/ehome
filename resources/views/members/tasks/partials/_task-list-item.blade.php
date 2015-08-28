<li>
    <div class="card">
        <div class="comment-avatar opacity-50">
            @if($task->isDone())
                <i class="fa fa-check text-success"></i>
            @elseif($task->isPending())
                <i class="fa fa-hourglass-start text-default-light"></i>
            @else
                <i class="fa fa-hourglass-half flat-turq"></i>
            @endif
        </div>
        <div class="card-body">
            <a href="{{route('task.show', $task->id)}}">
                {{-- Task Name --}}
        	    <h4 class="comment-title">{{str_limit($task->present()->prettyName, 40)}}
        	        {{-- Task Priority --}}
        	        <span class="stick-top-right small-padding {{$task->isImportant()?'flat-green':'flat-orange'}}" data-toggle="tooltip" title="{{$task->isImportant()?'Important':'Optional'}}"><i class="fa fa-circle"></i></span>
        	        {{-- Task Due --}}
        	         <small class="stick-top-right small-padding {{$task->hasExpired()?'flat-red':'text-default-light'}}" style="margin-right: 30px;">{{$task->hasExpired()?'Expired':'Expires'}} {{Carbon::parse($task->due_at)->diffForHumans()}}</small>
        	    </h4>
        	</a>

        	<span class="stick-bottom-left small-padding text-default-light" style="margin-left:10px">
        	    {{-- Task has Image --}}
        	    @if($task->hasImage())
        	       <span class="mg-rt-5" data-toggle="tooltip" title="Image"><i class="fa fa-image"></i></span>
                @endif
                {{-- Task Has Location --}}
                @if($task->hasLocation())
                    <span class="mg-rt-5" data-toggle="tooltip" title="Location"><i class="fa fa-map-marker"></i></span>
        	    @endif
        	</span>

        	<span class="stick-bottom-right small-padding">
                {{-- Task Status --}}
        	    <span class="mg-rt-5 {{$task->isPending()?'text-default-light':'flat-green'}}">Status: {{$task->present()->prettyStatus}}</span>

           	    @if($currentUser->isHead() && !$task->hasExpired())
           	       {{-- Update Task --}}
                   <a href="{{route('task.edit', $task->id)}}" class="link-look text-default-light mg-rt-5" data-toggle="tooltip" data-title="Update Task?">
                       <i class="fa fa-pencil"></i>
                   </a>
                   {{-- Cancel Task --}}
                   {!! Form::open(['class' => 'inline-block mg-rt-5', 'route' => ['task.destroy', $task->id], 'method' => 'DELETE', 'data-form-remote']) !!}
                       <button type="submit" class="link-look text-default-light"
                       data-toggle="tooltip" data-title="Cancel Task?"
                       data-confirm="Do you want to cancel task?">
                           <i class="fa fa-trash"></i>
                       </button>
                   {!! Form::close() !!}
                @endif
        	</span>

            {{-- Task Description --}}
        	<p>{{$task->present()->prettyDescription}}</p>
        </div>
    </div>
</li>