@extends('layout')

@section('content')
    
    @foreach ($questions as $question)
        <p>
            <a href="{{route('questions.show', ['question' => $question])}}">
                {{$question->title}}
            </a>
        
        
        {{-- <p>{{$question->user->name}}</p> --}}

        <x-updated :date='$question->created_at' name='{{$question->user->name}}' user_id='{{$question->user->id}}'></x-updated>

        @can('update', $question)
            <a class="btn btn-primary" href="{{route('questions.edit', ['question' => $question->id])}}">Edit</a>
        @endcan

        @if (!$question->trashed())
            @can('delete', $question)
                <form method="POST" action="{{route('questions.destroy', ['question' => $question->id])}}">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-primary mt-2" type="submit" value="Delete">
                </form>
                
            @endcan
            
        @endif

        </p>

        <p>
            {{$question->answers_count}} Answers
        </p>

        <p>
            {{$question->likes_count}} Likes
        </p>

        <hr>

    @endforeach 
    {{$questions->withQueryString()->links('pagination::bootstrap-5')}}


@endsection
