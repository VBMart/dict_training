@extends('layouts.app_test')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 80vh">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Подставь слово
                </div>
                <div class="card-body">
                    @if (is_null($success))
                        <p class="card-text">{{$sentence->ru}}</p>
                        <p class="card-text">{{str_ireplace($word->word, '______', $sentence->en)}}</p>

                        <form method="post" action="{{route('test.random')}}" autocomplete="off">
                            @csrf
                            <input type="text" name="word">
                            <input type="hidden" name="word_id" value="{{$word->id}}">
                            <input type="hidden" name="sentence_id" value="{{$sentence->id}}">
                            <button type="submit" class="btn-primary">Проверить</button>
                        </form>

                        <button class="btn btn-primary mt-3" type="button" data-toggle="collapse" data-target="#collapseHint" aria-expanded="false" aria-controls="collapseHint">
                            Подсказка
                        </button>
                        <div class="collapse mt-3" id="collapseHint">
                            <div class="card card-body">
                                Первая буква: {{$word->word[0]}}
                            </div>
                        </div>
                    @else
                        <p class="card-text">{{$sentence->ru}}</p>

                        @if ($success)
                            <p class="card-text">{!! str_ireplace($word->word, '<span class="badge badge-success">'.$word->word.'</span>', $sentence->en) !!}</p>
                            <div class="alert alert-success" role="alert">
                                <b>Правильно!</b>
                            </div>
                        @else
                            <p class="card-text">{!! str_ireplace($word->word, '<span class="badge badge-danger">'.$word->word.'</span>', $sentence->en) !!}</p>
                            <div class="alert alert-danger" role="alert">
                                Ошибка: [{{$userWord}}]
                            </div>
                        @endif


                        <a href="{{route('test.random')}}" class="btn btn-primary" role="button" id="next">
                            Следующее
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
