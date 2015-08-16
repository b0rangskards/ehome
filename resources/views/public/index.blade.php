<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Home</title>

    {!! HTML::style('css/public.css') !!}
</head>
<body>
        @include('public.partials._header')

        @include('public.partials._content')

        @include('public.partials._footer')

    {!! HTML::script('js/public.js') !!}
</body>
</html>