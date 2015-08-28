@extends('layouts.master-member')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-head style-primary">
               <header>User Settings</header>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                    {!! Form::open(['route' => ['profile.deactivate', $currentUser->id], 'method' => 'DELETE']) !!}
                        {!!Form::submit('Deactivate Account?', ['class' => 'link-look text-danger'])!!}
                    {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@stop