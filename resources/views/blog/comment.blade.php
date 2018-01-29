@foreach($articles as $article)
        <div class="works-div">
                <div class="works-top">
                    <span class="works-add">
                        文章>>计算机
                    </span>
                    <span class="works-time works-add">
                        {{$article->created_at}}
                    </span>
                </div>
                <div class="works-container-div">
                    <div class="works-container" >
                        <h1 data-target="#body_{{$article->id}}" data-toggle="collapse"><a href="####">{{$article->title}}</a></h1>
                        <div class="works collapse" id="body_{{$article->id}}">
                            <p>
                                {!!$article->body!!}
                            </p>
                        </div>
                    </div>
                    <div class="features-div clear">
                        <div class="left-features btn-group">
                            <button type="button" class="btn btn-default" data-target="#createComment_{{$article->id}}" data-toggle="collapse">评论</button>
                            <button type="button" class="btn btn-default">分享</button>
                            <button type="button" class="btn btn-default">复制</button>
                            <button type="button" class="btn btn-default select_com" data-target="#comment_{{$article->id}}" data-toggle="collapse" onclick="viewComments(this)" data="{{$article->id}}">查看评论</button>
                        </div>
                        <div class="right-features btn-group">
                            <button type="button" class="btn btn-success">赞一个</button>
                            <button type="button" class="btn btn-danger">踩一个</button>
                        </div>
                    </div>
                    <div class="collapse comment-from" id="comment_{{$article->id}}">
                        <div class="load" style="margin: 0 auto;"></div>
                        <div class="comment-top">
                            <h4 class="left-features">0 条评论</h4>
                            <button type="button" class="btn btn-default right-features">依时间排序</button>
                        </div>
                        <div class="com-div">
                        </div>
                    </div>
                    <div id="createComment_{{$article->id}}" class=" collapse ">
                        <div class="creCom-div" >
                            <div required="" value="" placeholder="写下你的评论…" class="input-Com" data-input-box="true"  contenteditable="true" ></div>
                        </div>
                        <button type="button" class="btn btn-primary creCom-btn" onclick="creCom_btn(this)" data="{{$article->id}}">评论</button>
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
                </div>
                
        </div>
        @endforeach
        <script type="text/javascript">
        function viewComments(obj,updata)
            {
                console.log(obj)
                if($(obj).parent().parent().next().find('.comment-item').length<=0||updata)
                {
                    var id = obj.getAttribute('data');
                    var htmlobj=$.ajax(
                    {
                        url:"/blog/public/comment/article/"+id,
                        success:function()
                        {
                            json_data = eval(htmlobj.responseText)
                            createComments($('#comment_'+id).find(".com-div"),json_data)
                        }
                    });
                }
            }
            function createComments($obj,data)
            {
                console.log($obj)
                $obj.empty();
                $obj.parent().find('.comment-top').find('h4')[0].innerText = data.length+" 条评论";
                for(var i=0;i<data.length;i++)
                {   
                    $obj.append
                    ("<div class='comment-item'><div><div class='comment-meta'><p></p></div><div class='comment-body'><p>"
                    +data[i]['content']+
                    "</p></div></div></div>")
                }
                $obj.parent().find('.load').css('display','none');
            }
            function creCom_btn(obj)
            {
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
                        viewComments($(obj).parent().prev().prev().find('.left-features').find('.select_com')[0],true);
                    },
                    error: function(msg) {
                    var json=JSON.parse(msg.responseText);
                    alert(json)
                    },
                });
            }
        </script>