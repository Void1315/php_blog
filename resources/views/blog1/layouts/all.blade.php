<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>
		个人主页
	</title>
	<link rel="stylesheet" type="text/css" href="{{asset('/css/all.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/blog1/css/custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/blog1/css/pace.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/blog1/css/my.css')}}">
	<script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('/js/clipboard.min.js')}}"></script>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>    	
</head>
<body>
		<div class="container">	
			<header id="site-header">
				<div class="row">
					<div class="col-md-4 col-sm-5 col-xs-8">
						<div class="logo">
							<h1><a href="{{url('/')}}"><b>Black</b> &amp; White</a></h1>
						</div>
					</div><!-- col-md-4 -->
					<div class="col-md-8 col-sm-7 col-xs-4">
						<nav class="main-nav" role="navigation">
							<div class="navbar-header">
  								<button type="button" id="trigger-overlay" class="navbar-toggle">
    								<span class="ion-navicon glyphicon glyphicon-align-justify"></span>
  								</button>
							</div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  								<ul class="nav navbar-nav navbar-right">
    								<li class="cl-effect-11"><a href="{{url('/')}}" data-hover="Home">Home</a></li>
    								<li class="cl-effect-11"><a href="{{url('/blog')}}" data-hover="Blog">Blog</a></li>
    								<li class="cl-effect-11"><a href="{{url('/video')}}" data-hover="Video">Video</a></li>
    								<li class="cl-effect-11"><a href="{{url('/image')}}" data-hover="Image">Image</a></li>
  								</ul>
							</div><!-- /.navbar-collapse -->
						</nav>
						<div id="header-search-box">
							<a id="search-menu" href="#"><span id="search-icon" class="ion-ios-search-strong"></span></a>
							<div id="search-form" class="search-form">
								<form role="search" method="get" id="searchform" action="#">
									<input type="search" placeholder="Search" required>
									<button type="submit"><span class="ion-ios-search-strong"></span></button>
								</form>				
							</div>
						</div>
					</div><!-- col-md-8 -->
				</div>
			</header>
		</div>
		@yield('single')
		@yield('index')
		@yield('video')
		@yield('full')
		@yield('image')
		<footer id="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright">&copy; 2014 ThemeWagon.com -More Templates  - Collect from </p>
					</div>
				</div>
			</div>
		</footer>
		<div class="overlay overlay-hugeinc">
			<button type="button" class="overlay-close"><span class="ion-ios-close-empty"></span></button>
			<nav>
				<ul>
					<li><a href="{{url('/')}}">Home</a></li>
					<li><a href="{{url('/blog')}}">Blog</a></li>
					<li><a href="{{url('/video')}}">Video</a></li>
					<li><a href="{{url('/image')}}">Image</a></li>
				</ul>
			</nav>
		</div>
    <script type="text/javascript" src="{{asset('/blog1/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/blog1/js/modernizr.custom.js')}}"></script>
	<script type="text/javascript" src="{{asset('/blog1/js/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/blog1/js/script.js')}}"></script>

</body>
</html>
