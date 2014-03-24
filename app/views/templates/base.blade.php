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
    </ul>

    @yield('body')

    {{-- JS HERE --}}
</body>
</html>