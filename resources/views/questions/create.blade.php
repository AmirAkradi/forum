@extends('layout')

@section('content')


    <form method="POST" action="{{route('questions.store')}}">
        @csrf
        @include('questions._form')

        <div class="form-group">
            {{-- <input type="submit" class="btn btn-primary btn-block"> --}}
            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </div>

    </form>
    <x-errors></x-errors>




@endsection
