@extends('admin.layouts.defalut')
@section('words')
<div class="main" id="the_title" data="words">
	<div class="container" style="margin-top: 50px;" >
		<div class="title-div">
			<input type="text" name="title" class="form-control" id="word-title" style="margin-bottom: 50px;" autocomplete="off" maxlength="30" placeholder="在这输入你的标题......" value="{{$article->title}}">
		</div>
		<div id="editor">
			<div>
				{!!$article->body!!}
			</div>
	    </div>
	    <button id="btn1" class="btn btn-success btn-block" onclick="updataWords()">提交</button>
	</div>

   	 <script type="text/javascript">
   	 	var id = {{$article->id}};
        var E = window.wangEditor
        var editor = new E('#editor')
        editor.create()
            document.getElementById('btn1').addEventListener('click', function () {
		    }, false)
	    function updataWords()//修改文章
	    {
	    	title = $('#word-title').val();
	    	body = editor.txt.html();
	    	$.ajax(
	    		{
	    			url:"{{url('admin/word/updata')}}",
		    		type:'post',
		    		data:{'_token':'{{csrf_token()}}','title':title,'body':body,'id':id},
		    		success:function(data)
                    {
                       $('#editor').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的文章已经修改。3秒后跳转到管理页</div>")
                      	setTimeout(function()
                       	{
                       		window.location.href="{{url('/admin/manage/word')}}";
                       	}
                       	, 3000)
                    },
                    error: function(msg) {
	                    var json=JSON.parse(msg.responseText);
						$('#editor').append("<div class='alert alert-warning'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>失败！</strong>"+json+"</div>")
                    },
	    		}
	    		)
	    }
    </script>
</div>
@endsection