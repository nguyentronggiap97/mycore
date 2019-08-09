@foreach ($menus as $route => $item)
    <a href="{{ url($route) }}">{{ $item['text'] }}</a>
@endforeach

@if (Route::has('login'))
    <a href="#"></a>
    @auth
    <a href="{{ url(config('backend.route')) }}">Backend</a>
    @else
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    @endauth
@endif