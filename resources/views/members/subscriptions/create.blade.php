@extends('layouts.master-member')


@section('content')

@include('members.subscriptions.partials._side-menu')

<div class="row">
    <div class="col-sm-8">

        @include('flash::message')

       {!! Form::open(['route' => ['subscriptions.extend', $currentUser->id]]) !!}

        <div class="card">
            <div class="card-head style-primary">
               <header>Extend Subscription</header>
            </div>

            <div class="card-body">
                <div class="row">
                   <div class="col-md-8 col-md-offset-2">
                       <div class="form-group {{$errors->has('subscription_type')?'has-error':''}}">
                       @foreach($subscriptions as $subscription)
                           <div class="card style-default-light">
                               <div class="card-body">
                                   <div class="col-md-1">
                                       <label class="radio-inline radio-styled radio-primary">
                                           {!! Form::radio('subscription_type', $subscription->id) !!}
                                       </label>
                                   </div>
                                   <div class="col-md-7">
                                       <span class="text-medium text-lg text-muted">{{$subscription->present()->prettyDaysCount}}</span>
                                   </div>
                                   <div class="col-md-4"><span class="text-lg pull-right">{{$subscription->present()->prettyAmount}}</span></div>
                               </div>
                           </div>
                       @endforeach
                       <p class="help-block">{{$errors->has('subscription_type')?'Please select a subscription.':''}}</p>
                       </div>
                   </div>
                </div>

                <hr/>

            </div>

            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <div class="pull-left">
                        <h4 class="text-default-light text-medium pull-left">Payment Method</h4>
                        <div>
                            <img src="{{asset('images/paypal.png')}}" alt=""/>
                        </div>
                    </div>
                    <span class="stick-bottom-right small-padding">
                        {!! Form::submit('Subscribe', ['class' => 'btn btn-flat btn-accent ink-reaction']) !!}
                    </span>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>

@stop