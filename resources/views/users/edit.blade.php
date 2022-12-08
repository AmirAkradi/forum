@extends('layout')

@section('content')

    <form method="POST" enctype="multipart/form-data"  action="{{route('users.update', ['user' => $user->id])}}" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4">
                <img src="{{ $user->image ? $user->image->url() : '' }}" class="img-thumbnail" style="width: 128px; height:128px;">
                <div class="card-body mt-4 card">
                    <h6>Upload a photo</h6>
                    <input type="file" name="avatar" class="form-control-file">
                </div>
            </div>
            
            <div class="col-8">
                    
                
                <div class="form-group">
                    <label>Name:</label>
                    <input class="form-control" name="name" type="text" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input class="form-control" name="username" type="text" value="{{$user->username}}">
                </div>
            
                <input type="submit" class="btn btn-primary mt-4" value="Save Changes">

            </div>

            <x-errors></x-errors>
        </div>
    </form>



    

    {{-- <x-updated :date='$question->created_at' name='{{$question->user->name}}'></x-updated>

    @auth
        @if ($question->likes->where('id', Auth::id())->count() == 1)
            <button class="btn btn-success">Liked</button>
        @else
            <form method="POST" action="{{route('questions.like.store', ['question' => $question->id])}}">
                @csrf
            
                <button type="submit" class="btn btn-primary mt-2">Like</button>
            
            </form>
        @endif
    @endauth --}}

@endsection
