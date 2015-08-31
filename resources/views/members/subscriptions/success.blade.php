@extends('layouts.master-member')


@section('content')

@include('members.subscriptions.partials._side-menu')

<div class="row">
    <div class="col-sm-5 col-sm-offset-1">


        <div class="card">

            <div class="card-body">
                <div class="row">
                   <div class="col-md-12">

                    <div>
                        <h4 class="text-default-light">Subscription:</h4> {{$subscription_type->present()->prettyType}} - {{$subscription_type->present()->prettyDaysCount}}
                    </div>
                    <br/>

                    <div>
                        <h4 class="text-default-light">Amount Billed:</h4> {{$subscription_type->present()->prettyAmount}}
                    </div>
                    <br/>

                    <div>
                        <p class="text-default-light">Your Subscription will Expire on <span class="text-primary">{{$subscription->present()->expirationDate}}</span></p>
                    </div>
                    <hr/>
                    <div class="row text-center">
                        <a href="{{route('home')}}" class="btn btn-primary ink-reaction" href="">Continue</a>
                    </div>

                   </div>
                </div>
            </div>

        </div>
    </div>
</div>

@stop