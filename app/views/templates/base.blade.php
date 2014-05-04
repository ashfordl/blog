<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    {{--  CSS HERE --}}
    @yield('head')
</head>
<body>
    {{-- NAVBAR --}}
    <ul>
        <li><a href="{{ route('blog') }}">Blog</a></li>
        <li><a href="{{ route('bloglist') }}">Archive</a></li>
    </ul>

    {{-- Login Information --}}
    @if (!isset($nologin) || !$nologin)
        @if (Auth::check())
            <a href="{{ route('settings') }}">{{{ Auth::user()->display_name }}}</a>
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <span><b>Not logged in</b> <a href="{{ route('login') }}">Log in</a> <a href="{{ route('register') }}">Register</a></span>
        @endif
    @endif

    @yield('body')

    {{-- JS HERE --}}
</body>
</html>