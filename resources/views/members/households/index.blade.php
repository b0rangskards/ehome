@extends('members.partials._household-master')
@section('card-body')

<div class="col-md-8">
    {{--Members here--}}
    @include('members.households.partials._members-sm')
</div>

    {{-- Household info --}}
    @include('members.households.partials._household-side-info')

@stop