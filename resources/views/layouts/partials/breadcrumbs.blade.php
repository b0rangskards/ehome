<div class="section-header">
	<ol class="breadcrumb">
		<li><a href="{!! route('home') !!}">home</a></li>
		@if(isset($breadcrumbPages) && count($breadcrumbPages) > 0)
            @foreach($breadcrumbPages as $index => $page)
                <li class="{!! (count($breadcrumbPages)-1) == $index ? 'active':'' !!}">
                @if(isset($page['link']))
                  <a href="{!! $page['link'] !!}">{!! $page['name'] !!}</a>
                @else
                  {!! $page['name'] !!}
                @endif
                </li>
            @endforeach
		@endif
		{{--<li class="active">Household</li>--}}
	</ol>
</div>