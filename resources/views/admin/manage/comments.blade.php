@extends('admin.layouts.defalut')
@section('manComments')
<div class="main">
	<div class="container" style="margin-top: 50px;" id="the_title" data="manage">
		<div class="mangword-top" id="top-id">
				<h3>评论管理</h3>
				<span id="count">共 ({{count($comments)}}) 条评论</span>
				<a href="{{url('/admin/manage/comments/up')}}" style="float: right;"><span id="spid">排序方式：按修改时间</span></a>
			</div>
			<div class="word-item">
			@foreach($comments as $comment)
				<div class="mangword-con">
					<a href="#"><h3>{{$comment->content}}</h3></a>
					<div class="item-meta">
						<a href="#" onclick="deleteWord(this)" data='{{$comment->id}}'><span>删除</span></a>
						<span class="zg-bull">•</span>
						共 {!!mb_strlen($comment->content)!!}字
						<span class="zg-bull">•</span>
						{{$comment->updated_at}}
						<span class="zg-bull">•</span>
						文章->>
						<a href="{{url('/article',$comment->article_id)}}"><span>{{$comment->title}}</span></a>
					</div>
				</div>
			@endforeach
			<div style="display: flex;justify-content: center;">
				{{ $comments->links() }}
			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	if(document.location.href=="{{url('admin/manage/comments/up')}}")
	{
		$('#spid')[0].innerText = "排序方式：按默认";
		$('#spid').attr('href',"{{url('admin/manage/comments')}}");
	}

	var ia = {{count($comments)}};
	// console.log(i)
	function deleteWord(obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{
			url:"{{url('/admin/delete/comments')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','id':id},
		    		success:function(data)
                    {
                       $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的评论已经删除。</div>")
                       $(obj).parent().parent().remove();
                       $('#count')[0].innerText = "共"+(--ia)+" 条评论";
                    },
                    error: function(msg) {
						$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")

                    },
		})
	}
</script>
@endsection