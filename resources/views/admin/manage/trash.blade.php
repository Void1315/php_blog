@extends('admin.layouts.defalut')
@section('trash')
<div class="main">
	<div class="container" style="margin-top: 50px;" id="the_title" data="trash">
		<div>
			<div class="mangword-top" id="top-id" style="margin: 0;">
				<h3>我的回收站</h3>
				<a href="" style="float: right;"><span>排序方式：按大小</span></a>
			</div>
			<div  class="word-item">
			@if(isset($articles))
					@foreach($articles as $article)
						<div class="mangword-con">
							<a href="####"><h2>{{$article->title}}</h2></a>
							<div class="some-text">
								<h4>{!!mb_substr($article->body,0,80)!!}</h4>
							</div>
							<div class="item-meta">
								<span>
									<button type="button" class="btn btn-info" onclick="restore('article',this)" data='{{$article->id}}'>恢复</button>
								</span>
								<span class="zg-bull">•</span>
								<a href="####">
									<button type="button" class="btn btn-danger" onclick="delete_article(this)" data="{{$article->id}}">删除</button>
								</a>
								<span class="zg-bull">•</span>
								共 {!!mb_strlen($article->body)!!}字
								<span class="zg-bull">•</span>
								{{$article->updated_at}}
								<span class="zg-bull">•</span>
								文章
							</div>
						</div>
					@endforeach
				@endif
				@if(isset($images))
					<ul style="padding: 0;">
						@foreach($images as $image)
							<li class="image-li">
								<div class="image-box">
									<a href="{{url($image->path)}}">
										<img src="{{url($image->path)}}" class="img-thumbnail img-responsive" style="max-width: 250px;max-height: 250px;">
									</a>
									<div style="margin: auto;">
									<div>
											<button type="button" class="btn btn-info" onclick="restore('upload',this)" data='{{$image->id}}'>恢复</button>
											<button type="button" class="btn btn-danger" onclick="delete_upload(this)" data="{{$image->id}}">删除</button>
									</div>
									</div>
									<div class="image-box-right">
										<h2>{{$image->name}}</h2>
										<span>{{$image->updated_at}}</span>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				@endif
				@if(isset($comments))
					@foreach($comments as $comment)
						<div class="mangword-con">
							<a href="####"><h3>{{$comment->content}}</h3></a>
							<div class="item-meta">
								<a href="####" >
									<button type="button" class="btn btn-info" onclick="restore('comment',this)" data='{{$comment->id}}'>恢复</button>
								</a>
								<span class="zg-bull">•</span>
								<button type="button" class="btn btn-danger" onclick="delete_comments(this)" data="{{$comment->id}}">删除</button>
								<span class="zg-bull">•</span>
								共 {!!mb_strlen($comment->content)!!}字
								<span class="zg-bull">•</span>
								{{$comment->updated_at}}
								<span class="zg-bull">•</span>
								评论
							</div>
						</div>
					@endforeach
				@endif
					@if(isset($videos))
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
									<div class="flex-srud" style="margin: 15px 0;">
										<button type="button" onclick="restore('upload',this)" class="btn btn-success btn-lg" data="{{$video->id}}">恢复</button>
										<button type="button" onclick="delete_upload(this)" class="btn btn-danger btn-lg" data="{{$video->id}}">删除</button>
								</div>
							</div>
						</li>
					@endforeach
					</ul>
				@endif
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function restore(type,obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{

			url:"{{url('/admin/restore')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','type':type,'id':id},
			success:function(data)
                    {
                       $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的文件已经恢复。</div>")
                       $(obj).parent().parent().parent().remove();
                    },
                    error: function(msg) {
						$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
                    },
		})
	}
	function delete_article(obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{
			url:"{{url('/admin/kill/article')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','type':'article','id':id},
			success:function(data)
                    {
                       $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的文章已经删除。</div>")
                       $(obj).parent().parent().parent().remove();
                    },
                    error: function(msg) {
						$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
                    },
		})
	}
	function delete_comments(obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{
			url:"{{url('/admin/kill/comment')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','type':'comment','id':id},
			success:function(data)
                    {
                       $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的评论已经删除。</div>")
                       $(obj).parent().parent().remove();
                    },
                    error: function(msg) {
						$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
                    },
		})
	}
	function delete_upload(obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{
			url:"{{url('/admin/kill/upload')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','type':'upload','id':id},
			success:function(data)
                    {
                       $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的文件已经删除。</div>")
                       $(obj).parent().parent().parent().remove();
                    },
                    error: function(msg) {
						$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
                    },
		})
	}
</script>
@endsection