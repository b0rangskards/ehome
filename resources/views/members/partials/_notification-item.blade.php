<a data-recipient="{{$currentUser->id}}" class="alert alert-callout alert-success notification {{$notification->seen==1?'seen':''}}" href="{{$notification->link}}">
    <img class="pull-left img-circle dropdown-avatar" src="{{ asset('images/icon-user-default.png') }}" alt="" />
    <strong>{{$notification->sender->present()->prettyName}}</strong>
    <span class="time">{{ $notification->present()->informalSentDate }}</span>
    <br/>
    <div class="elipses-overflow-notification"><small class="text-muted">{{str_limit($notification->present()->prettyTitle, 40)}}</small></div>
</a>