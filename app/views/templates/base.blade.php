<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | Blog</title>

    {{-- CSS --}}
        <link href="{{ asset('res/css/custom-bootstrap.css') }}" rel="stylesheet">
        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @yield('head')
</head>
<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and mobile toggle button -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">Blog</a>
            </div>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Blog</a></li>
                    <li><a href="{{ action('BlogController@getList') }}">Archive</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        @if (Auth::user()->isAdmin())
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ action('BlogAdminController@getIndex') }}">Blog</a></li>
                                    <li><a href="{{ action('UserAdminController@getIndex') }}">User</a></li>
                                </ul>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown">User <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ action('UserController@getSettings') }}">{{{ Auth::user()->display_name }}}</a></li>
                                <li><a href="{{ action('UserController@getLogout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown">User <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ action('UserController@getLogin') }}">Login</a></li>
                                <li><a href="{{ action('UserController@getRegister') }}">Register</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('body')
    
    {{-- JS --}}
        <script src="{{ asset('res/lib/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('res/lib/bootstrap.min.js') }}"></script>
    @yield('js')
</body>
</html>