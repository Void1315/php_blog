@extends('admin.layouts.defalut')
@section('video')
	<div class="main" id="the_title" data="upload">
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
				<div id="ii">
					<a href="####" >
						<div id="holder" style="background-image: url('{{asset('/img/upload.png')}}');" onclick="clickFile()">
							<input type="file" name="file"  id="upload" onchange="uploadVideo()" style="display: none;" >
						</div>
					</a>
				</div>
				
				
				<div class="progress">
				    <div class="progress-bar" style="transition: width 1s ease;" role="progressbar" aria-valuenow="0" 
				        aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="the_bar" >
				    </div>
				</div>
				
			</div>
		</div>
	</div>
	<script type="text/javascript">
		// var iswork = false; 
		function clickFile()
		{
				$("#upload")[0].click();
		}
		function  uploadVideo(file) 
		{
			if(window.FormData) 
			{
				var xhr = new XMLHttpRequest();
				xhr.upload.onprogress = function (event) //进度条
				{
					if(event.lengthComputable) //信息可用
					{
			　　　　　　var complete = (event.loaded / event.total * $('#the_bar').parent().width());
			　　　　　　var progress = $('#the_bar');
			　　　　　　progress.css('width',complete) 
			　　　　}
		　　　　}
		　　　　var formData = new FormData();
		　　　　// 建立一个upload表单项，值为上传的文件
				if(!file)
					file = document.getElementById('upload').files[0];
		　　　　formData.append('file', file);
		　　　　formData.append('_token', "{{csrf_token()}}");
		　　　　xhr.open('POST', "{{url('/admin/create/video')}}");
		　　　　// 定义上传完成后的回调函数
				xhr.send(formData);
		　　　　xhr.onload = function () 
				{
		　　　　　　if (xhr.status === 200) 
					{
						$('#ii').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong></strong>"+xhr.responseText+"</div>")
		　　　　　　} 
					else 
					{
		　　　　　　　　$('#ii').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>				失败！</strong>视频没上传成功</div>")
		　　　　　　}
		　　　　};
		　　}
			else
			{
				alert("不支持的浏览器")
			}
		}
		

		if('draggable' in document.createElement('span'))
		{
	　　　　var holder = $('#holder')[0];
	　　　　holder.ondragover = function () 
			{ 
				this.className = 'hover'; 
				return false; 
			};
	　　　　holder.ondragend = function () 
			{ 
				this.className = '';
				 return false;
			}

	　　　　holder.ondrop = function (event) {
	　　　　　　event.preventDefault();//取消默认事件
				if(event.dataTransfer.files.length>1)
				{
					alert("不支持多文件");
					return ;
				}
	　　　　　　var file = event.dataTransfer.files[0];//
				uploadVideo(file);
	　　　　};
	　　}
	</script>
@endsection