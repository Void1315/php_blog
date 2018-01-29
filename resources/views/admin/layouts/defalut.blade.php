<!DOCTYPE html>
<html >
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('/css/uplods.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/config.css')}}">
	<link rel="stylesheet" href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	
	<link rel="stylesheet" type="text/css" href="{{asset('/css/mang_word.css')}}">
		<script type="text/javascript" src="{{asset('/js/wangEditor/release/wangEditor.js')}}"></script>
	<link rel="stylesheet" href="{{asset('/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<!-- ICONS -->
	<link rel="stylesheet" type="text/css" href="{{asset('/uploader/dist/ssi-uploader/styles/ssi-uploader.css')}}">
		<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/uploader/dist/ssi-uploader/js/ssi-uploader.min.js')}}"></script>

	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('/img/favicon.png')}}">
		<script type="text/javascript" src="{{asset('/js/clipboard.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('/js/config.js')}}"></script>
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#"><img src="{{asset('/img/logo-dark.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>你有9条评论</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>帮助</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">基础管理</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{url($admin->image)}}" class="img-circle" alt="Avatar"> <span>{{$admin->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="{{ url('/admin/out') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{url('/admin')}}" class="a-nav-side" data="home"><i class="lnr lnr-home"></i> <span>主页</span></a></li>
						<li><a href="{{url('/admin/words')}}" class="a-nav-side" data="words"><i class="lnr lnr-pencil"></i> <span>发布文章</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="a-nav-side collapsed" data="manage" aria-expanded="1"><i class="lnr lnr-cog"></i> <span>管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="{{url('admin/manage/word')}}" class="a-list">文章管理</a></li>
									<li><a href="{{url('/admin/manage/comments')}}" class="a-list">评论管理</a></li>
									<li><a href="{{url('/admin/manage/image')}}" class="a-list">图片管理</a></li>
									<li><a href="{{url('/admin/manage/video')}}" class="a-list">视频管理</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#upData-div" data-toggle="collapse" class="collapsed a-nav-side" aria-expanded="1" data="upload"><i class="lnr lnr-location"></i> <span>上传</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="upData-div" class="collapse a-nav-side" data="upload">
								<ul class="nav">
									<li><a href="{{url('admin/uploads/image')}}" class="a-list">上传图片</a></li>
									<li><a href="{{url('admin/uploads/video')}}" class="a-list">上传视频</a></li>
								</ul>
							</div>
						</li>
						<li><a href="{{url('admin/trash')}}" class="a-nav-side" data="trash"><i class="lnr lnr-trash"></i><span>回收站</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		@yield('main')
		@yield('config')
		@yield('words')
		@yield('word')
		@yield('mang_word')
		@yield('upImage')
		@yield('manImage')
		@yield('manComments')
		@yield('trash')
		@yield('video')
		@yield('manvideo')
	</div>
	<div class="clearfix"></div>
</body>
	<script src="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('/vendor/chartist/js/chartist.min.js')}}"></script>
	<script src="{{asset('/scripts/klorofil-common.js')}}"></script>
	<script type="text/javascript" src="{{asset('/js/title.js')}}"></script>
</html>