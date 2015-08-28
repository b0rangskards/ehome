<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Home</title>

    {!! HTML::style('http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900') !!}
    {!! HTML::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! HTML::style('css/vendor.css') !!}
    {!! HTML::style('css/app.css') !!}

</head>
<body class="menubar-hoverable header-fixed">

    @include('layouts.partials.top-nav')

	<!-- BEGIN BASE-->
	<div id="base">

        @include('layouts.partials.offcanvas')

        <div id="content">

        @yield('content')

        </div>

        @include('layouts.partials.member-side-nav')
	</div>
	<!-- END BASE -->

@include('layouts.partials.member-footer')