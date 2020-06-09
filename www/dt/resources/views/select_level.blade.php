@extends('layouts.app_test')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 90vh">
        <div class="col-md-5">
            <div class="card mb-3">
                <div class="card-header">
                    Выбери уровень:
                </div>
                <div class="card-body text-center">

                    @foreach($levels as $lvl)
                        <a href="{{route('test.random', ['level' => $lvl])}}" style="width:30%" class="btn btn-primary mb-2 mr-1" role="button" id="next">
                            {{$lvl->name}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
