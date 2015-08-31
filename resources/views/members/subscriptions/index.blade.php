@extends('layouts.master-member')


@section('content')

@include('members.subscriptions.partials._side-menu')

<div class="row">
    <div class="col-sm-7 col-sm-offset-1">
        <div class="card">
            <div class="card-head">
               <header>My Subscription</header>
            </div>

            <div class="card-body">
                <div class="row">
                     <div class="small-padding">
                         <span class="text-lg text-default-light">Subscription:</span>&nbsp; <span class="text-success">{{$subscription->type->present()->prettyType}}</span> - {{$subscription->type->present()->prettyDaysCount}}
                     </div>
                     <br/>
                     <div class="small-padding">
                         <p class="text-default-light">Your Subscription will Expire on <span class="text-success">{{$subscription->present()->expirationDate}}</span></p>
                     </div>

                     <div class="small-padding">
                        <p class="text-default-light">Expiration will be <span class="text-success text-lg">{{$subscription->present()->timeLeft}}</span></p>
                     </div>

                </div>
            </div>

        </div>
    </div>
</div>

@stop