@extends('layouts.app_test')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 90vh">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Подставь слово <a href="{{route('test.select_level')}}" style="float:right">(Уровень: {{$level->name}})</a>
                </div>
                <div class="card-body">
                    @if (is_null($success))
                        <p class="card-text">{{$sentence->ru}}</p>
                        <p class="card-text">{{str_ireplace($word->word, '______', $sentence->en)}}</p>

                        <form method="post" action="{{route('test.random', ['level' => $level])}}" autocomplete="off">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="word" autofocus placeholder="Введите слово">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Проверить</button>
                                </div>
                            </div>

                            <input type="hidden" name="word_id" value="{{$word->id}}">
                            <input type="hidden" name="sentence_id" value="{{$sentence->id}}">
                        </form>

                        <div id="accordion" class="col-md-5 mt-3 px-0 pt-1">
                            <div class="card">
                                <div class="card-header py-2 px-3" id="headingOne">
                                    <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" size="small">
                                        Первая буква
                                    </a>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body py-3 px-3">
                                        <h4 class="text-uppercase mb-0">{{$word->word[0]}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header py-2 px-3" id="headingTwo">
                                    <a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" size="small">
                                       Перевод
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body py-3 px-3">
                                        {{$oxfordWord->ru1}}
                                        @if ($oxfordWord->ru2 != '')
                                            , {{$oxfordWord->ru2}}
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
