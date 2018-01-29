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
