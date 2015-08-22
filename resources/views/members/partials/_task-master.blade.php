@extends('layouts.master-member')
@section('content')

<div class="row">

    {{-- Flash Messages --}}
    @include('flash::message')

    {{-- Task Navigation --}}
    @include('members.partials._task-nav')

    <div class="col-sm-9">
        {{-- Task Content --}}
        <div class="card">
            @yield('card-content')
        </div>
    </div>

</div>
@stop