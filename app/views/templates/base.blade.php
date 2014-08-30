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
    <div class="container-fluid page-header">
        <h2 class="page-title">Blog Title</h2>
    </div>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and mobile toggle button -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-content">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Blog</a></li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach (Category::all() as $category)
                                <li><a href="{{ action('BlogController@getCategory', array($category->id, $category->getTitleURLString())) }}">{{{ $category->title }}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ action('BlogController@getList') }}">Archive</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        @if (Auth::user()->isAdmin())
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ action('BlogAdminController@getIndex') }}">Posts</a></li>
                                    <li><a href="{{ action('CategoryAdminController@getIndex') }}">Categories</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ action('UserAdminController@getIndex') }}">Users</a></li>
                                </ul>
                            </li>
                        @endif
                            <li><p class="navbar-text">Logged in as <a href="{{ action('UserController@getSettings') }}" class="navbar-link">{{{ Auth::user()->display_name }}}</a></p></li>
                            <li><a href="{{ action('UserController@getLogout') }}">Logout</a></li>
                    @else
                            <li><a href="{{ action('UserController@getLogin') }}">Login</a></li>
                            <li><a href="{{ action('UserController@getRegister') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        @yield('body')
    </div>

    {{-- JS --}}
    <script src="{{ asset('res/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('res/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    @yield('js')
</body>
</html>