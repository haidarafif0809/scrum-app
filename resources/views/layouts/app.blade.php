<?php 
// $url = ((@$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://'). ($_SERVER['SERVER_NAME'] == '192.168.1.123' ? $_SERVER['SERVER_NAME'] .'/scrum_app/public' : $_SERVER['SERVER_NAME']) : 'http://'. ($_SERVER['SERVER_NAME'] == '192.168.1.123' ? $_SERVER['SERVER_NAME'] .'/scrum_app/public' : $_SERVER['SERVER_NAME']));


$pathApp = explode('/', $_SERVER['PHP_SELF']);
$pathApp = '/'. $pathApp['1'] .'/'. $pathApp['2'] .'/';
$url = ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://'. $_SERVER['HTTP_HOST'] . $pathApp : (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] .'/');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="img" href="favicon.ico">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="<?=$url;?>css/bootstrap<?=(isset($_COOKIE['tema']) && $_COOKIE['tema'] != 'default' ? '-'. $_COOKIE['tema'] : '.min');?>.css" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <link  href="{{ asset('css/themes.css') }}" rel="stylesheet">
    <link  href="{{ asset('css/timepicker.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                            <li><a href="{{ url('/home') }}">Dashboard</a></li>
                            <li><a href="{{ route('users.index') }}">Data User</a></li>
                            <li><a href="{{ route('teams.index') }}">Team</a></li>
                            <li><a href="{{ url('/backlog') }}">Backlog</a></li>
                            <li><a href="{{ route('aplikasi.index') }}">Aplikasi</a></li>
                            <li><a href="{{ route('sprints.index') }}">Sprint</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Tema <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li <?=(null == @$_COOKIE['tema'] || @$_COOKIE['tema'] == 'default' ? 'class="active"' : '');?>><a href="{{ url('tema/default') }}">Default</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'cerulean' ? 'class="active"' : '');?>><a href="{{ url('tema/cerulean') }}">Cerulean</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'cosmo' ? 'class="active"' : '');?>><a href="{{ url('tema/cosmo') }}">Cosmo</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'cyborg' ? 'class="active"' : '');?>><a href="{{ url('tema/cyborg') }}">Cyborg</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'darkly' ? 'class="active"' : '');?>><a href="{{ url('tema/darkly') }}">Darkly</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'flatly' ? 'class="active"' : '');?>><a href="{{ url('tema/flatly') }}">Flatly</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'journal' ? 'class="active"' : '');?>><a href="{{ url('tema/journal') }}">Journal</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'lumen' ? 'class="active"' : '');?>><a href="{{ url('tema/lumen') }}">Lumen</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'paper' ? 'class="active"' : '');?>><a href="{{ url('tema/paper') }}">Paper</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'readable' ? 'class="active"' : '');?>><a href="{{ url('tema/readable') }}">Readable</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'sandstone' ? 'class="active"' : '');?>><a href="{{ url('tema/sandstone') }}">Sandstone</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'simplex' ? 'class="active"' : '');?>><a href="{{ url('tema/simplex') }}">Simplex</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'slate' ? 'class="active"' : '');?>><a href="{{ url('tema/slate') }}">Slate</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'solar' ? 'class="active"' : '');?>><a href="{{ url('tema/solar') }}">Solar</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'spacelab' ? 'class="active"' : '');?>><a href="{{ url('tema/spacelab') }}">Spacelab</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'superhero' ? 'class="active"' : '');?>><a href="{{ url('tema/superhero') }}">SuperHero</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'united' ? 'class="active"' : '');?>><a href="{{ url('tema/united') }}">United</a></li>
                                    <li <?=(@$_COOKIE['tema'] == 'yeti' ? 'class="active"' : '');?>><a href="{{ url('tema/yeti') }}">Yeti</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Masuk</a></li>
                            <li><a href="{{ url('/register') }}">Mendaftar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @include('layouts._flash')
        @yield('content')
    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="//cdn.jsdelivr.net/jquery.ui.timepicker.addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script type="text/javascript">
    $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true});
        });

    $(function() {
  $('#timepicker').timepicker();
});
</script>
@yield('scripts')

    <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
</body>
</html>

