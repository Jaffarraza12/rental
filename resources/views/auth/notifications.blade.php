@if (count($errors->all()) > 0)
{{--<div class="alert alert-danger alert-block">
	Please check the form below for errors
</div>--}}
@endif


@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    @if(is_array($message))
        @foreach ($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('error') || count($errors->all()) > 0)
<div class="alert alert-danger alert-block">
        {{$errors->first("email")}}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif
