@extends('layout')

@section('content')
    <h1>{{$question->title}}</h1>
    <p>{{$question->content}}</p>

    <x-updated :date='$question->created_at' name='{{$question->user->name}}'></x-updated>

    @auth
        @if ($question->likes->where('id', Auth::id())->count() == 1)
            <button class="btn btn-success">Liked</button>
        @else
            <form method="POST" action="{{route('questions.like.store', ['question' => $question->id])}}">
                @csrf
            
                <button type="submit" class="btn btn-primary mt-2">Like</button>
            
            </form>
        @endif
    @endauth

    <h5>Answers</h3>

    @auth
        <div class="mt-2 md-2">
            <form method="POST" action="{{route('questions.answers.store', ['question' => $question->id])}}">
                @csrf
                <div class="form-group">
                    <textarea type="text" name="content" class="form-control"></textarea>
                </div>
            
                <button type="submit" class="btn btn-primary mt-2">Post Answer</button>
            
            </form>

            <x-errors></x-errors>
        </div>  

    @else
        <a href="{{route('login')}}">Sign in</a> to post answer
    @endauth

    @forelse ($answers as $answer)

        <p>
            <a href="{{route('users.show', ['user' => $answer->user->id])}}"><b>{{$answer->user->name}}</b></a> says: {{$answer->content}} 
            
            <p class="text-muted">
                {{$answer->created_at->diffForHumans()}}
            </p>
        </p>

        <p>
            {{$answer->likes_count}} like
        </p>

        @auth
            @if ($answer->likes->where('id', Auth::id())->count() == 1)
                <button class="btn btn-success">Liked</button>
            @else
                <form method="POST" action="{{route('answers.like.store', ['answer' => $answer->id])}}">
                    @csrf
                
                    <button type="submit" class="btn btn-primary mt-2">Like</button>
                
                </form>
            @endif
        @endauth

        <hr>

    @empty

        <p>
            There is no answer for this question
        </p>

    @endforelse

    {{$answers->withQueryString()->links('pagination::bootstrap-5')}}
@endsection
