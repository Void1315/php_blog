<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Comment;
use App;
use Illuminate\Routing\Route;

class CommentsController extends Controller
{
    //
    public function articleComment($id)
    {
    	echo Comment::where('article_id',"$id")->get();
    }
    public function createArticleComment(Request $request)
    {
        $judgeTime = App::make('creator');
        $time_size = 10;

        
        if(is_int($judgeTime->judgeTime($time_size)))
        {
            return "请休息一会!".$judgeTime->judgeTime($time_size)."秒后再评论";
        }
		$this->validate($request, [
		        'content' => 'required|max:255',
		        'article_id'=>'required',
		    ]);
		if (Comment::create(Input::all())) {
     		return "评论发表成功!";
	    } else {
	      return Redirect::back()->withInput()->withErrors('评论发表失败！');
	    }
    }
}
