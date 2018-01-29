@extends('admin.layouts.defalut')
@section('words')
<div class="main" id="the_title" data="words">
	<div class="container" style="margin-top: 50px;">
		<div class="title-div">
			<input type="text" name="title" class="form-control" id="word-title" style="margin-bottom: 50px;" autocomplete="off" maxlength="30" placeholder="在这输入你的标题......">
		</div>
		<div id="editor">
	    </div>
	    <button id="btn1" class="btn btn-success btn-block" onclick="creatWords()">提交</button>
	    <label for="inputfile">附加本体图片 请先上传 在复制地址</label>
	    <input type="file" name="file" multiple id="ssi-upload"/>
	</div>

   	 <script type="text/javascript">
   	 		$('#ssi-upload').ssi_uploader({
		    url: "{{url('admin/create/image')}}",
		    data:{'_token':'{{csrf_token()}}'},
		    maxFileSize:10,
		    onUpload:function(msg){
		  		 console.log(msg);
		  		},
		  	ajaxOptions:{success:function(msg)
		  		{
		  			alert(msg);
		  		}}
		});


        var E = window.wangEditor
        var editor = new E('#editor')
        editor.create()
            document.getElementById('btn1').addEventListener('click', function () {
		    }, false)
	    function creatWords()//创建文章
	    {
	    	title = $('#word-title').val();
	    	body = editor.txt.html();
	    	$.ajax(
	    		{
	    			url:"{{url('admin/words/submit')}}",
		    		type:'post',
		    		data:{'_token':'{{csrf_token()}}','title':title,'body':body},
		    		success:function(data)
                    {
                       $('#editor').append("<div class='alert alert-success'> <a href='#'' class='close' data-dismiss='alert'> &times; </a><strong>成功！</strong>您的文章已经接收。3秒后跳转到管理页</div>")
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