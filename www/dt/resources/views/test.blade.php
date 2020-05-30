@extends('layouts.app')

@section('content')
<div class="title m-b-md">
    @if($user != '')
        {{$text}}, {{strtoupper($user)}}
    @else
        Hello
    @endif
</div>
@endsection
