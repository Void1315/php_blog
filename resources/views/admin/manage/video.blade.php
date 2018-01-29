@extends('admin.layouts.defalut')
@section('manvideo')
	<div class="main">
	<div class="container" style="margin-top: 50px;" id="the_title" data="manage">
		<div>
			<div class="mangword-top" id="top-id" style="margin: 0;">
				<h3>我的视频</h3>
				<a href="" style="float: right;"><span>排序方式：按大小</span></a>
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			</div>
				<div >
					<ul style="padding: 0;">
					@foreach($videos as $video)
						<li class="image-li">
							<h1>{{$video->name}}</h1>
							<div class="video-box">
								<div >
									<a href="{{url('/video',$video->id)}}" target="_blank">
										<img src="{{asset('img/favicon.png')}}" class=" img-responsive img-thumbnail" style="width: 100%;max-height: 180px;" >
									</a>
								</div>
								<div >
									<div class="flex-srud" style="margin: 15px 0;">
										<button type="button" onclick="changeName(this)" class="btn btn-success btn-lg" data="{{$video->id}}">修改名称</button>
										<a href="{{url($video->path)}}" download>
											<button type="button" class="btn btn-default btn-lg">下载</button>
										</a>
										<button type="button" onclick="delete_video(this)" class="btn btn-danger btn-lg" data="{{$video->id}}">删除</button>
									</div>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
					<div style="margin: 0 auto;width: 174px;">
						{{ $videos->links() }}
					</div>
				</div>
		</div>
	</div>
	<script type="text/javascript">
		function changeInput(obj)
		{
			var $par = obj.parent();
			var name  = obj[0].innerText;
			obj.remove();
			$par.prepend("<input type='text' name='name' class='form-control' value='"+name+"'>")
		}
		function delete_video(obj)
		{
			var id = obj.getAttribute('data');
			$.ajax(
			{
				url:"{{url('/admin/delete/video')}}",
				type:'post',
				data:{'_token':'{{csrf_token()}}','id':id},
				success:function(data)
	            {
	               $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的视频已经删除。</div>")
	               $(obj).parent().parent().parent().parent().remove();
	            },
	            error: function(msg) {
					$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
	            },
			})	
		}
		function changeName(obj)
		{
			var $the_name = $(obj).parent().parent().parent().prev(); 
			obj.innerText = "保存修改"
			obj.onclick = function()
			{
				var id = this.getAttribute('data');
				// alert(id);
				var the_name = $(obj).parent().parent().parent().prev()[0].value; 
				// alert(the_name)
				$.ajax(
				{
					url:"{{url('/admin/manage/video/change')}}",
					type:'post',
					data:{'_token':'{{csrf_token()}}','id':id,'name':the_name},
					success:function(data)
                    {
                       $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的名称已经修改</div>")
                       },
                    error: function(msg) {
						$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
                    },
				})
			};
			changeInput($the_name);
		}
	</script>
@endsection