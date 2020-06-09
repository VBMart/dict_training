@extends('layouts.app_test')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 80vh">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Подставь слово <span style="float:right">(Уровень: {{$level->name}})</span>
                </div>
                <div class="card-body">
                    @if (is_null($success))
                        <p class="card-text">{{$sentence->ru}}</p>
                        <p class="card-text">{{str_ireplace($word->word, '______', $sentence->en)}}</p>

                        <form method="post" action="{{route('test.random', ['level' => $level])}}" autocomplete="off">
                            @csrf
                            <input type="text" name="word" autofocus>
                            <input type="hidden" name="word_id" value="{{$word->id}}">
                            <input type="hidden" name="sentence_id" value="{{$sentence->id}}">
                            <button type="submit" class="btn-primary">Проверить</button>
                        </form>

                        <div id="accordion" class="mt-3">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Первая буква
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Первая буква: {{$word->word[0]}}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Перевод
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        {{$oxfordWord->ru1}}
                                        @if ($oxfordWord->ru2 != '')
                                            {{$oxfordWord->ru2}}
                                        @endif
                                    </div>
                                </div>
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


                        <a href="{{route('test.random', ['level' => $level])}}" class="btn btn-primary" role="button" id="next" autofocus>
                            Следующее
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
