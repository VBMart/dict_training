@extends('layouts.app_test')

@section('content')
@if (is_null($success))
    <p>{{$sentence->ru}}</p>
    <p>{{str_replace($word->word, '______', $sentence->en)}}</p>

    <form method="post" action="{{route('test.random')}}">
        @csrf
        <input type="text" name="word">
        <input type="hidden" name="word_id" value="{{$word->id}}">
        <input type="hidden" name="sentence_id" value="{{$sentence->id}}">
        <button type="submit" class="btn-primary">Проверить</button>
    </form>
@else
    <p>{{$sentence->ru}}</p>
    <p>{!! str_replace($word->word, '<b>'.$word->word.'</b>', $sentence->en) !!}</p>

   @if ($success)
       <div class="alert alert-success" role="alert">
           Угадал [{{$userWord}}]
       </div>
   @else
       <div class="alert alert-danger" role="alert">
           Ошибка [{{$userWord}}]
       </div>
   @endif


   <a href="{{route('test.random')}}">
       <button class="btn-primary">Повторить</button>
   </a>
@endif
@endsection
