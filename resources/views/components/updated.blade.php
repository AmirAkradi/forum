@props(['date' => '{{now()}}', 'name' => 'John Doe', 'user_id' => 1])

<p class="text-muted">
    Added: {{$date->diffForHumans()}} By: <a href="{{route('users.show', ['user' => $user_id])}}">{{$name}}</a>
</p>