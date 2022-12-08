@extends('layout')

@section('content')

    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : '' }}" class="img-thumbnail" style="width: 128px; height:128px;">
        </div>
        <div class="col-8">

            {{-- {{dd($user)}} --}}

            <h1>{{$user->name}}</h1>
            <p>Username: {{$user->username}}</p>
            <p>Number of question: {{$user->questions_count}}</p>
            <p>Number of answer: {{$user->answers_count}}</p>

        </div>
    </div>


@endsection
