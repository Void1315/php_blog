@extends('admin.layouts.defalut')
@section('manImage')
<div class="main">
	<div class="container" style="margin-top: 50px;" id="the_title" data="manage">
		<div>
			<div class="mangword-top" id="top-id" style="margin: 0;">
				<h3>我的图片</h3>
				<a href="" style="float: right;"><span>排序方式：按大小</span></a>
			</div>
			<div  class="word-item">
				<ul style="padding: 0;">
				@foreach($images as $image)
					<li class="image-li">
						<div class="image-box">
							<a href="{{url($image->path)}}">
								<img src="{{url($image->path)}}" class=" img-responsive img-thumbnail" style="width: 250px;" >
							</a>
							<div style="margin: auto;">
								<div>
									<button type="button" class="btn  btn-lg btn-info" data-clipboard-text="{{url($image->path)}}">复制地址</button>
									<a href="{{url($image->path)}}" download>
										<button type="button" class="btn  btn-lg btn-success" data-clipboard-text="{{url($image->path)}}" >下载</button>
									</a>
									<button type="button" class="btn btn-lg btn-danger" onclick="delete_image(this)" data="{{$image->id}}">删除</button>
								</div>
							</div>
							<div class="image-box-right">
								<h2></h2>
								<span>{{$image->updated_at}}</span>
							</div>
						</div>
					</li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	new Clipboard('.btn');
	function delete_image(obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{
			url:"{{url('/admin/delete/image')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','id':id},
			success:function(data)
            {
               $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的图片已经删除。</div>")
               $(obj).parent().parent().parent().parent().remove();
            },
            error: function(msg) {
                var json=JSON.parse(msg.responseText);
				$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong>"+json+"</div>")
            },
		})	
	}
	// function SaveAs5(imgURL) 
	// {
	// 	imgURL = imgURL.getAttribute('data-clipboard-text');
	// 	console.log(imgURL)
	// 	var oPop = window.open(imgURL,"","width=1, height=1, top=5000, left=5000"); 
	// 	for(; oPop.document.readyState != "complete"; ) 
	// 	{ 
	// 	if (oPop.document.readyState == "complete")break; 
	// 	} 
	// 	oPop.document.execCommand("SaveAs"); 
	// 	// oPop.close(); 
	// } 
</script>
@endsection