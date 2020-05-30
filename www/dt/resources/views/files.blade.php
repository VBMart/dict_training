@extends('layouts.app')

@section('content')

    <table>
        <tr>
            <th>ID</th>
            <th>File Name</th>
            <th>Using</th>
        </tr>
        @foreach($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->file_name}}</td>
                @if($file->using == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
            </tr>
        @endforeach
    </table>

@endsection
