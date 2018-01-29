@extends('admin.layouts.defalut')
@section('mang_word')
<div class="main">
	<div class="container" style="margin-top: 50px;" id="the_title" data = 'manage'>
		<div class="mangword-div">
			<div class="mangword-top" id="top-id">
				<h3>我的文章</h3>
				<a href="{{url('/admin/manage/word/up')}}" id="spid" onclick="poststrlen()" style="float: right;"><span>排序方式：按修改时间</span></a>
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
			<div class="word-item">
			@foreach($articles as $article)
				<div class="mangword-con">
					<a href="../../admin/words/{{$article->id}}" target="_blank"><h2>{{$article->title}}</h2></a>
					<div class="some-text">
						<h4>{!!mb_substr($article->body,0,80)!!}</h4>
					</div>
					<div class="item-meta">
						<a href="#" onclick="deleteWord(this)" data='{{$article->id}}'><span>删除</span></a>
						<span class="zg-bull">•</span>
						<a href="../../admin/words/{{$article->id}}" target="_blank">编辑</a>
						<span class="zg-bull">•</span>
						共 {!!mb_strlen($article->body)!!}字
						<span class="zg-bull">•</span>
						{{$article->updated_at}}
						<span class="zg-bull">•</span>
						文章
						<span class="zg-bull">•</span>
						{{$article->support}}人赞同
						<span class="zg-bull">•</span>
						{{$article->opposition}}人反对
					</div>
				</div>
				@endforeach
					<div style="display: flex;justify-content: center;">
					{{ $articles->links() }}
						
					</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	if(document.location.href=="{{url('admin/manage/word/up')}}")
	{
		$('#spid')[0].innerText = "排序方式：按默认";
		$('#spid').attr('href',"{{url('admin/manage/word')}}");
	}
	function deleteWord(obj)
	{
		var id = obj.getAttribute('data');
		$.ajax(
		{
			url:"{{url('/admin/delete/word')}}",
			type:'post',
			data:{'_token':'{{csrf_token()}}','id':id},
    		success:function(data)
            {
               $('#top-id').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的文件已经恢复。</div>")
               $(obj).parent().parent().remove();
            },
            error: function(msg) {
				$('#top-id').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong></div>")
            },
		})
	}
</script>
@endsection