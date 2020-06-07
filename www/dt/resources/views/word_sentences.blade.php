@extends('layouts.app')

@section('content')

    <h1>{{$word->word}} ({{count($word->sentences)}}) id: {{$word->id}}</h1>

    <table>
        <tr>
            <th>id</th>
            <th>EN</th>
            <th>RU</th>
        </tr>
        @foreach($word->sentences as $sentence)
            <tr>
                <td>{{$sentence->id}}</td>
                <td>{{$sentence->en}}</td>
                <td>{{$sentence->ru}}</td>
            </tr>
        @endforeach
    </table>

@endsection
