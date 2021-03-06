<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
     @yield('seo')
     
     <meta name="author" content="Cufrancis" />
    <meta name="copyright" content="2016 www.cufrancis.com" />
    {!! Setting()->get('website_header') !!}

    <title>{{ Setting()->get('website_name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700"> --}}

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    @yield('css')
</head>
<body>
<div class="top-common-nav">
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
                    {{ Setting()->get('website_name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li @if(request()->route()->getName() == 'website.index') class="active" @endif><a href="{{ route('website.index') }}">Index<span class="sr-only">(current)</span></a></li>
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                @if (Auth::guest())
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <ul class="nav navbar-nav user-menu navbar-right">
                        <li><a href="{{ route('auth.notification.index') }}" class="active" id="unread_notifications"><span class="fa fa-bell-o fa-lg"></span></a></li>
                        <li><a href="{{ route('auth.message.index') }}" class="active" id="unread_messages"><i class="fa fa-envelope-o fa-lg"></i></a></li>
                        <li class="dropdown user-avatar">
                            <a href="{{ route('auth.profile.base') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="avatar-32 mr-5" alt="{{ Auth()->user()->name }}" src="{{ route('website.image.avatar',['avatar_name'=>Auth()->user()->id.'_middle'])}}" >
                                <span>{{ Auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @if( Auth()->user()->permissions >= 5)
                                    <li><a href="{{ route('website.admin.index') }}">系统设置</a></li>
                                    <li class="divider"></li>
                                @endif

                                <li><a href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}">我的主页</a></li>
                                <li><a href="{{ route('auth.notification.index') }}">我的私信</a></li>
                                <li><a href="{{ route('auth.profile.base') }}">账号设置</a></li>
                                <li class="divider"></li>
																<li><a href="{{  route('website.link.create')}}">创建链接</li>
                                <li><a href="{{ url('/logout') }}">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</div>

<div class="clearfix"></div>
    <div class="wrap mt-60">
        @yield('jumbotron')
        @yield('container')
        <div class="container">
            <!--[if lt IE 9]>
            <div class="alert alert-danger topframe" role="alert">你的浏览器实在<strong>太太太太太太旧了</strong>，放学别走，升级完浏览器再说
                <a target="_blank" class="alert-link" href="http://browsehappy.com">立即升级</a>
            </div>
            <![endif]-->
    <div class="container">
      @if ( session('message') )
        <div class="alert @if(session('message_type')===1) alert-danger @else alert-success @endif alert-dismissible" role="alert" id="alert_message">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('message') }}
        </div>
      @endif
      
      @yield('content')
    </div>

<footer id="footer">
  {{-- <div class="container">
    @if(request()->route()->getName() == 'website.index')
    <ul class="list-unstyled list-inline">
        <li>友情链接</li>
        @foreach($friendshipLinks as $link)
        <li><a target="_blank" href="{{ $link->url }}" title="{{ $link->slogan }}">{{ $link->name }}</a></li>
        @endforeach
    </ul>
    @endif
    <div class="text-center">
        <a href="{{ route('website.index') }}">{{ Setting()->get('website_name') }}</a><span class="span-line">|</span>
        <a href="mailto:tipask@qq.com" target="_blank">联系我们</a><span class="span-line">|</span>
        <a href="http://www.miibeian.gov.cn" target="_blank">{{ Setting()->get('website_icp') }}</a>
    </div>
    <div class="copyright mt-10">
        Powered By <a href="http://www.tipask.com" target="_blank">{{ Config('tipask.version') }}</a> Release {{ config('tipask.release') }} ©2009-{{ gmdate('Y') }} tipask.com
    </div>
  </div> --}}
</footer>

  <!-- JavaScripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
  @yield('script')
  
  {!! Setting()->get('website_footer') !!}
</body>
</html>
