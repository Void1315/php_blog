@extends('admin.layouts.defalut')
@section('config')
<div class="main" style="margin-bottom: 50px;">
<br><br>
	<div class="container" id="the_title">
		<div class="config-div">
			<div class="config-top">
				<ul class="the-carousel">
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
			<div class="config-under">
				<div class="user-img  ">
					<div class="img-div">
						<a href="####" onclick="up_image()"><img id="i-img" src="{{asset($admin->image)}}" class="img-thumbnail img-responsive"></a>
					</div>
					
				</div>
				<div class="config-user ">
					<h3>{{$admin->name}}</h3>
					<span>{{$admin->introduction}}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="config-z">
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
			<form method="post" enctype="multipart/form-data" action="/blog/public/admin/config/change">
			 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			 	<input type="file" id="file_image" name="image" style="display: none;" onchange= "readFile(this)">
				<div class="info-config ">
					<h3>昵称</h3>
					<input type="text" name="name" class="form-control config-input" placeholder="填写你的昵称" value="{{$admin->name}}">
				</div>
				<div class="info-config ">
					<h3>邮箱</h3>
					<input type="text" name="email" class="form-control config-input" placeholder="输入你的邮箱" value="{{$admin->email}}">
				</div>
				<div class="info-config ">
					<h3>手机号</h3>
					<input type="text" name="telphone" class="form-control config-input" placeholder="输入你的手机号" value="{{$admin->telphone}}">
				</div>
				<div class="info-config ">
					<h3>一句话介绍</h3>
					<input type="text" name="introduction" class="form-control config-input" placeholder="输入你的自我介绍" value="{{$admin->introduction}}">
				</div>
				<button type="submit" class="btn btn-info config-btn">保存</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{asset('/js/config.js')}}"></script>
<script type="text/javascript">
 	function up_image()
	{
		$("#file_image").click();

	}
	function readFile(obj){ 
	    var file = obj.files[0]; 
	    if(!/image\/\w+/.test(file.type)){ 
	        alert("文件必须为图片！"); 
	        return false; 
	    } 
	    var reader = new FileReader(); 
	    reader.readAsDataURL(file); 
	    reader.onload = function(e){ 
	    	content = e.target.result;
	        $('#i-img')[0].src = content
	    } 
} 
</script>
@endsection