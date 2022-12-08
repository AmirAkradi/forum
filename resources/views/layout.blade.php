<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js'])
    <title>Document</title>
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Forum</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="/">Home</a>
            <a class="p-2 text-dark" href="{{ route('questions.index') }}">Questions</a>
            <a class="p-2 text-dark" href="{{ route('questions.create') }}">Ask Question</a>



            @guest

                <a class="p-2 text-dark" href="{{route('login')}}">Login</a>
                <a class="p-2 text-dark" href="{{route('register')}}">Register</a>
                
            @else
                <a class="p-2 text-dark" href="{{route('users.edit', ['user' => Auth::id()])}}">Profile</a>
                <a class="p-2 text-dark" href="{{route('logout')}}" 
                    onclick="event.preventDefault();document.getElementById('logout.form').submit();">
                    Logout({{Auth::user()->name}})
                </a>
                
                <form id="logout.form" action="{{route('logout')}}" method="POST">
                    @csrf
                </form>

            @endguest


			
        </nav>
    </div>

    <div class="container">
        @if(session()->has('status'))
            <p style="color: green">
                {{ session()->get('status') }}
            </p>
        @endif

        @yield('content')
    </div>
    
</body>
</html>