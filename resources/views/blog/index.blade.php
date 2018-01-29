<!DOCTYPE html>
<html>
<head>
    <title>个人主页</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/all.css')}}">
    <script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>
     <script type="text/javascript" src="{{asset('/js/comment-js.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
</head>
<body>
    @include('_layouts.head')
    <div class="container">
		        <div class="article-div">
			<div class="img-div">
				<img src="{{$user->image}}" class="img-rounded img-thumbnail img-responsive" style="width: 200px;">
			</div>
			<div class="introduce">
				<em>
					作者：
					<p>{{$user->name}}</p>
				</em>
				<em>
					邮箱：
					<p>{{$user->email}}</p>
				</em>
				<em>
					简介：
					<p>{{$user->introduction}}</p>
				</em>
			</div>
		</div>
        @include('blog.comment')
    </div>
    @include('_layouts.foot')
</body>
</html>
