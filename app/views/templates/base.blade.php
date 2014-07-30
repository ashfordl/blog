<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | Blog</title>
    {{--  CSS HERE --}}
    @yield('head')
</head>
<body>
    {{-- NAVBAR --}}
    <ul>
        <li><a href="{{ route('home') }}">Blog</a></li>
        <li><a href="{{ action('BlogController@getList') }}">Archive</a></li>
        @if (Auth::check() && Auth::user()->isAdmin())
            <li><a href="{{ route('admin') }}">Admin</a></li>
        @endif
    </ul>

    {{-- Login Information --}}
    @if (!isset($nologin) || !$nologin)
        @if (Auth::check())
            <span>
                <a href="{{ action('UserController@getSettings') }}">{{{ Auth::user()->display_name }}}</a>
                <a href="{{ action('UserController@getLogout') }}">Logout</a>
            </span>
        @else
            <span>
                <b>Not logged in</b>
                <a href="{{ action('UserController@getLogin') }}">Log in</a>
                <a href="{{ action('UserController@getRegister') }}">Register</a>
            </span>
        @endif
    @endif

    @yield('body')
    
    @yield('js')
</body>
</html>