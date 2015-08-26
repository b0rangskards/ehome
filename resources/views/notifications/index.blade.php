@extends('layouts.master-member')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-body no-padding">
                        <ul class="list divider-full-bleed notifications-list">
                            @forelse($notifications as $notification)
                                <li data-recipient="{{$currentUser->id}}" class="tile notification {{$notification->seen==1?'seen':''}}">
                                    <a href="{{$notification->link}}" class="tile-content ink-reaction">
                                        <div class="tile-text">
                                            {{$notification->sender->present()->prettyName}}
                                            <small>{{str_limit($notification->present()->prettyTitle, 100)}}</small>
                                        </div>
                                    </a>
                                    <div class="stick-top-right text-default-light small-padding" style="padding-top: 0px"><i class="fa fa-clock-o"></i>&nbsp;{{$notification->present()->informalSentDate}}</div>
                                </li>
                            @empty
                                <li>
                                    <p class="text-center">You have no notifications.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div><!--end .card-body -->
                </div><!--end .card -->
                <div class="text-center">
                {!! $notifications->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@stop