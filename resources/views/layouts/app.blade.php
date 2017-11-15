<?php
$requestURI = @$_SERVER['REQUEST_URI'];
$tema = @$_COOKIE['tema'];
function ckeditor() {
  global $tema;
  switch ($tema) {
    case 'default':
    return 'ckeditor_moono_lisa';
    break;
    case 'cerulean':
    return 'ckeditor_kama';
    break;
    case 'cosmo':
    return 'ckeditor_icy_orange';
    break;
    case 'cyborg':
    return 'ckeditor_moono_dark';
    break;
    case 'darkly':
    return 'ckeditor_moono_dark';
    break;
    case 'flatly':
    return 'ckeditor_moono_blue';
    break;
    case 'journal':
    return 'ckeditor_icy_orange';
    break;
    case 'lumen':
    return 'ckeditor_kama';
    break;
    case 'paper':
    return 'ckeditor_flat';
    break;
    case 'readable':
    return 'ckeditor_office_2013';
    break;
    case 'sandstone':
    return 'ckeditor_moono_color';
    break;
    case 'simplex':
    return 'ckeditor_moono';
    break;
    case 'slate':
    return 'ckeditor_moono_dark';
    break;
    case 'solar':
    return 'ckeditor_moono_dark';
    break;
    case 'spacelab':
    return 'ckeditor_office_2013';
    break;
    case 'superhero':
    return 'ckeditor_moono_dark';
    break;
    case 'united':
    return 'ckeditor_icy_orange';
    break;
    case 'yeti':
    return 'ckeditor_moono';
    break;
  }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Favicon -->
  <link rel="icon" type="img" href="{{ asset('to-do-list.ico') }}">

  <!-- Styles -->

  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
  <link href="{{ asset('css/detail.css') }}" rel="stylesheet"> 
  <link href="{{ asset('css/about.css') }}" rel="stylesheet"> 
  <link href="{{ asset('css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
  <link href="{{ asset('') }}css/bootstrap<?=(isset($tema) && $tema != 'default' ? '-'. $tema : '.min');?>.css" rel="stylesheet" type='text/css'>
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
    <script type="text/javascript">
     $(document).ready(function () {
      var title = $('title').val();
      document.write(title);
    });
  </script>
  <!-- {{ asset('js') }} -->
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
     <li<?=(preg_match("/home/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/home') }}">Dashboard</a></li>
     @role('admin')
     <li class="dropdown <?=(preg_match("/(users|teams|aplikasi)/", $requestURI) ? 'active' : '');?>">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Master Data <span class="caret"></span></a>
      <ul class="dropdown-menu">
       <li<?=(preg_match("/users/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/admin/users') }}">Users</a></li>
       <li<?=(preg_match("/teams/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/admin/teams') }}">Team</a></li>
       <li<?=(preg_match("/aplikasi/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/admin/aplikasi') }}">Aplikasi</a></li>
     </ul>
   </li>
   @endrole
   <li<?=(preg_match("/^\/backlog/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/backlog') }}">Backlog</a></li>
   <li<?=(preg_match("/sprints/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/sprints') }}">Sprint</a></li>
   <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Tema <span class="caret"></span></a>
    <ul class="dropdown-menu">
     <li <?=(null == $tema || $tema == 'default' ? 'class="active"' : '');?>><a href="{{ url('tema/default') }}">Default</a></li>
     <li <?=($tema == 'cerulean' ? 'class="active"' : '');?>><a href="{{ url('tema/cerulean') }}">Cerulean</a></li>
     <li <?=($tema == 'cosmo' ? 'class="active"' : '');?>><a href="{{ url('tema/cosmo') }}">Cosmo</a></li>
     <li <?=($tema == 'cyborg' ? 'class="active"' : '');?>><a href="{{ url('tema/cyborg') }}">Cyborg</a></li>
     <li <?=($tema == 'darkly' ? 'class="active"' : '');?>><a href="{{ url('tema/darkly') }}">Darkly</a></li>
     <li <?=($tema == 'flatly' ? 'class="active"' : '');?>><a href="{{ url('tema/flatly') }}">Flatly</a></li>
     <li <?=($tema == 'journal' ? 'class="active"' : '');?>><a href="{{ url('tema/journal') }}">Journal</a></li>
     <li <?=($tema == 'lumen' ? 'class="active"' : '');?>><a href="{{ url('tema/lumen') }}">Lumen</a></li>
     <li <?=($tema == 'paper' ? 'class="active"' : '');?>><a href="{{ url('tema/paper') }}">Paper</a></li>
     <li <?=($tema == 'readable' ? 'class="active"' : '');?>><a href="{{ url('tema/readable') }}">Readable</a></li>
     <li <?=($tema == 'sandstone' ? 'class="active"' : '');?>><a href="{{ url('tema/sandstone') }}">Sandstone</a></li>
     <li <?=($tema == 'simplex' ? 'class="active"' : '');?>><a href="{{ url('tema/simplex') }}">Simplex</a></li>
     <li <?=($tema == 'slate' ? 'class="active"' : '');?>><a href="{{ url('tema/slate') }}">Slate</a></li>
     <li <?=($tema == 'solar' ? 'class="active"' : '');?>><a href="{{ url('tema/solar') }}">Solar</a></li>
     <li <?=($tema == 'spacelab' ? 'class="active"' : '');?>><a href="{{ url('tema/spacelab') }}">Spacelab</a></li>
     <li <?=($tema == 'superhero' ? 'class="active"' : '');?>><a href="{{ url('tema/superhero') }}">SuperHero</a></li>
     <li <?=($tema == 'united' ? 'class="active"' : '');?>><a href="{{ url('tema/united') }}">United</a></li>
     <li <?=($tema == 'yeti' ? 'class="active"' : '');?>><a href="{{ url('tema/yeti') }}">Yeti</a></li>
   </ul>
 </li>
 @endif
</ul>

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
 <!-- Authentication Links -->
 @if (Auth::guest())
 <li<?=(preg_match("/login/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/login') }}">Masuk</a></li>
 <li<?=(preg_match("/register/", $requestURI) ? ' class="active"' : '');?>><a href="{{ url('/register') }}">Mendaftar</a></li>
 @else
 <li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user-circle-o fa-spin fa-1x fa-fw" aria-hidden="true"></i>
    <span class="sr-only">Saving. Hang tight!</span>
    {{ Auth::user()->name }} <span class="caret"></span>
  </a>

  <ul class="dropdown-menu" role="menu">
   <li>
    <a href="{{ url('/settings/password') }}"><i class="fa fa-btn fa-lock"></i> Ubah Password</a>
  </li>
  <li>
    <a href="{{ url('/logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    <i class="glyphicon glyphicon-log-out"></i> Logout
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

<!-- footer -->
<footer class="text-center"> 
  <a class="up-arrow" id="back-to-top" href="#" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p> 2017 &copy; Scrum App &nbsp;&nbsp; <i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp; <a href="{{ url('/about') }}">Santri Programmer</a> &nbsp;&nbsp; <i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp; <a href="https://www.andaglos.id">Andaglos Global Teknologi</a></p> 
</footer>
<script>   
 $(window).scroll(function() {
  if($(this).scrollTop() &gt; 200) {
    $(&#39;#back-to-top&#39;).fadeIn();
  } else {
    $(&#39;#back-to-top&#39;).fadeOut();
  }
});
 $(&#39;#back-to-top&#39;).hide().click(function() {
  $(&#39;html, body&#39;).animate({scrollTop:0}, 1000);
  return false;
});         
</script>
<!-- akhir footer -->
<!-- Scripts -->

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/customize.js') }}"></script>
<script src="{{ asset('js/selectize.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/jquery-ui-timepicker-addon.min.js') }}"></script>
<!-- <script src="{{ asset('js/ckeditor_moono_lisa/ckeditor.js') }}"></script> -->
<script src="{{ asset('js') }}/<?=ckeditor();?>/ckeditor.js"></script>
<script>
  // Start of Tawk.to Script
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5a051b4b198bd56b8c03a4f2/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
  // End of Tawk.to Script
</script>

@yield('scripts')

</body>
</html>

