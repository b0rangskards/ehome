@extends('layouts.master-member')


@section('content')

@include('members.subscriptions.partials._side-menu')

<div class="row">
    <div class="col-sm-7 col-sm-offset-1">

        @foreach($subscriptionsHistory as $subscription)
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <span class="stick-top-right small-padding text-default-light">{{$subscription->present()->subscribedDateInformal}}</span>
                             <div class="small-padding">
                                 <span class="text-md text-default-light">Subscription:</span>&nbsp; <span class="text-success">{{$subscription->type->present()->prettyType}}</span> - {{$subscription->type->present()->prettyDaysCount}}
                             </div>
                             <div class="small-padding">
                                <span class="text-default-light">Subscribed at  <span class="text-primary">{{$subscription->present()->subscribedDate}}</span></span>
                                <span class="text-default-light"> to <span class="text-danger">{{$subscription->present()->expirationDate}}</span></span>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

@stop