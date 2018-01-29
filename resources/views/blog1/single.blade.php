@extends('blog1.layouts.all')
@section('single')
	<div class="content-body">
		<div class="container">
			<div class="row">
				<main class="col-md-8">
					<article class="post post-1">
						<header class="entry-header">
							<h1 class="entry-title">{{$article->title}}</h1>
							<div class="entry-meta">
								<span class="post-category"><a href="#">Web Design</a></span>
		
								<span class="post-date"><a href="#"><time class="entry-date" datetime="2012-11-09T23:15:57+00:00">
								@if($article->updated_at)
									{{$article->updated_at}}
								@else
									{{$article->created_at}}
								@endif
								</time></a></span>
		
								<span class="post-author"><a href="#">Albert Einstein</a></span>
		
								<span class="comments-link"><a href="#">{!!mb_strlen($article->body)!!} 字</a></span>
							</div>
						</header>
						<div class="entry-content clearfix">
							{!!$article->body!!}
						</div>
								<div class="features-div clear">
								@if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif
		                        <div class="left-features btn-group">
		                           <button type="button" class="btn btn-default" data-target="#the_com" data-toggle="collapse">评论</button>
		                            <button type="button" class="btn btn-default">分享</button>
		                            <button type="button" class="btn btn-default" data-clipboard-text= "{{$article->body}}">复制</button>
		                            <button type="button" class="btn btn-default select_com" id="aaa" data-target="#more_com" data-toggle="collapse" onclick="viewComments(this)" data="{{$article->id}}">查看评论</button>
		                        </div>
		                        <div class="right-features btn-group">
		                        	<span class="support">+1S</span>
		                            <button type="button" class="btn btn-success" onclick="supportSpan()">赞一个</button>
		                            <span class="opposition">-1S</span>
		                            <button type="button" class="btn btn-danger" onclick="Opposition()">踩一个</button>
		                        </div>
		                    </div>
		                    <div class="collapse comment-from " id="more_com">
		                        <div class="load" style="margin: 0 auto;"></div>
		                        <div class="comment-top">
		                            <h4 class="left-features">0 条评论</h4>
		                            <button type="button" class="btn btn-default right-features">依时间排序</button>
		                        </div>
		                        <div class="com-div">
		                   		 </div>
		                   	</div>
		                    <div id="the_com" class=" collapse  ">
		                        <div class="creCom-div" >
		                            <div required="" value="" id="div-input" placeholder="写下你的评论…" class="input-Com" data-input-box="true"  contenteditable="true" ></div>
		                        </div>
		                        <button type="button" data-input-box="true"   class="btn btn-primary creCom-btn" onclick="creCom_btn(this)" data="{{$article->id}}">评论</button>
		                    </div>
					</article>
				</main>
				<aside class="col-md-4">
					<div class="widget widget-recent-posts">		
						<h3 class="widget-title">Recent Posts</h3>		
						<ul>
							<li>
								<a href="#">Adaptive Vs. Responsive Layouts And Optimal Text Readability</a>
							</li>
							<li>
								<a href="#">Web Design is 95% Typography</a>
							</li>
							<li>
								<a href="#">Paper by FiftyThree</a>
							</li>
						</ul>
					</div>
					<div class="widget widget-archives">		
						<h3 class="widget-title">Archives</h3>		
						<ul>
							<li>
								<a href="#">November 2014</a>
							</li>
							<li>
								<a href="#">September 2014</a>
							</li>
							<li>
								<a href="#">January 2013</a>
							</li>
						</ul>
					</div>

					<div class="widget widget-category">		
						<h3 class="widget-title">Category</h3>		
						<ul>
							<li>
								<a href="#">Web Design</a>
							</li>
							<li>
								<a href="#">Web Development</a>
							</li>
							<li>
								<a href="#">SEO</a>
							</li>
						</ul>
					</div>
				</aside>
			</div>
		</div>
	</div>
    <script type="text/javascript">
    		new Clipboard('.btn');//复制对象


            function viewComments(obj,updata)
            {
               
                if($('.comment-item').length<=0||updata)
                {
                	console.log($('.comment-item').length)
                    var id = obj.getAttribute('data');
                    var htmlobj=$.ajax(
                    {
                        url:"/blog/public/comment/article/"+id,
                        success:function()
                        {
                            json_data = eval(htmlobj.responseText)
                            createComments($(".com-div"),json_data)
                        }
                    });
                }
            }
            function createComments($obj,data)
            {
                var $the_obj = $obj;
                $obj.empty();
                $obj.parent().find('.comment-top').find('h4')[0].innerText = data.length+" 条评论";
                for(var i=0;i<data.length;i++)
                {   
                    $obj.append
                    ("<div class='comment-item'><div><div class='comment-body' id='new_con'><p>"
                    +data[i]['content']+
                    "</p></div><div class='comment-meta'><span><b>发布时间 :</b></span><p>"+data[i]['created_at']+"</p></div></div></div>")
                }
                $obj.parent().find('.load').css('display','none');
                $('#div-input')[0].innerText = "";
            }
            function creCom_btn(obj)
            {
            	if(document.cookie.indexOf("conments" + "=")!=-1)
            	{
            		alert("一分钟前已经评论!请稍等后再评论")
            		return;
            	}
                var body = $(obj).prev().first()[0].innerText;
                var id = obj.getAttribute('data');
                var url = "/blog/public/create/comment/article";
                var htmlobj=$.ajax(
                {
                    url:url,
                    type:"post",
                    data:{'_token':'{{csrf_token()}}','content':body,'article_id':id},
                    success:function(data)
                    {
                    	time = new Date();
						time.setSeconds(10)
                        viewComments($('#aaa')[0],true);
                        document.cookie="conments=true"+";expires="+time+";HTTP:"+true;
                    },
                    error: function(msg) {
                    var json=JSON.parse(msg.responseText);
                    alert(json)
                    },
                });
            }


    		if({{$tourists}}<2)
    		{
    			if({{$tourists}}==1)
    				$('.support').next()[0].innerText ="已赞";
    			else
    				$('.opposition').next()[0].innerText ="已踩";
    		}

            function supportSpan()//
            {
            	if({{$tourists}}>1)
            	{
	            	$('.support').css('top','-35px');
	            	$('.support').css('opacity','0');

	            	$('.support').next()[0].innerText ="已赞";
	            	post_oppost(1);
            	}
            	else
            	{
            		alert("你已经执行过此操作!")
            	}
            	// console.log($('.support').next())
            }
            function post_oppost(type) 
            {
            	var id = {{$article->id}};
            	$.ajax({
            		url:"{{url('/article/oppost')}}",
            		type:'post',
            		data:{'_token':"{{csrf_token()}}",'type':type,'id':id},
            		success:function(data)
            		{
            			// console.log(data)
            		}
            	})
            }
            function  Opposition() //
            {
            	if({{$tourists}}>1)
            	{
	            	$('.opposition').css('top','-35px');
	            	$('.opposition').css('opacity','0');
	            	$('.opposition').next()[0].innerText ="已踩";
	            	post_oppost(0);
            	}
            	else
            	{
            		alert("你已经执行过此操作!")
            	}
            }
        </script>
@endsection
