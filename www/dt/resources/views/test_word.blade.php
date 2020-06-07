@extends('layouts.app_test')

@section('content')
    <div class="row align-items-center" style="height: 80vh;">
        <div class="col-2"></div>
        <div class="col-8 text-center">
@if (is_null($success))
    <br>
    <p>{{$sentence->ru}}</p>
    <p>{{str_ireplace($word->word, '______', $sentence->en)}}</p>

    <form method="post" action="{{route('test.random')}}">
        @csrf
        <input type="text" name="word">
        <input type="hidden" name="word_id" value="{{$word->id}}">
        <input type="hidden" name="sentence_id" value="{{$sentence->id}}">
        <button type="submit" class="btn-primary">Проверить</button>
    </form>
@else
    <br>
    <p>{{$sentence->ru}}</p>

   @if ($success)
       <p>{!! str_ireplace($word->word, '<span class="badge badge-success">'.$word->word.'</span>', $sentence->en) !!}</p>
       <div class="alert alert-success" role="alert">
           <b>Правильно!</b>
       </div>
   @else
       <p>{!! str_ireplace($word->word, '<span class="badge badge-danger">'.$word->word.'</span>', $sentence->en) !!}</p>
       <div class="alert alert-danger" role="alert">
           Ошибка: [{{$userWord}}]
       </div>
   @endif


   <a href="{{route('test.random')}}">
       <button class="btn-primary">Повторить</button>
   </a>
@endif
        </div>
    </div>
@endsection
