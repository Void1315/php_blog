<?php

namespace App\Http\Controllers\blog\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Upload;
use App\Article;
use App\Comment;
use App;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class TrashController extends Controller
{
    //
    public function show()
    {
    	$id = Auth::id();
    	$admin = User::where('id',Auth::id())->first();
	    $articles = Article::onlyTrashed()->where('user_id',$id)->get();
	    $images = Upload::onlyTrashed()->where('user_id',$id)->where('type','image')->get();
	    // if(Comment::onlyTrashed()->whereIn('article_id',Article::where('user_id',Auth::id())))
	    // {
	    // 	echo "string";
    	$comments = Comment::onlyTrashed()->whereIn('article_id',Article::where('user_id',$id)->get(['id']))->get();
        $videos = Upload::onlyTrashed()->where('user_id',$id)->where('type','video')->get();
	    return view('admin.manage.trash')->with('admin',$admin)->with('articles',$articles)->with('images',$images)->with('comments',$comments)->with('videos',$videos);
	    // }
	    // else
	    // 	return view('admin.manage.trash')->with('admin',$admin)->with('articles',$articles)->with('images',$images);
	    // }
    }
    public function killArticle(Request $request)
    {
        $id = $request->id;
        $article = Article::onlyTrashed()->where('id',$id)->first();
        $article->forceDelete();
    }
    public function killUpload(Request $request)
    {
        $id = $request->id;
        $video = Upload::onlyTrashed()->where('id',$id)->first();
        $path = $video->path;
        Storage::delete($path);
        $video->forceDelete();

    }
    public function killComment(Request $request)
    {
        $id = $request->id;
        $comment = Comment::onlyTrashed()->where('id',$id)->first();
        $comment->forceDelete();
    }
    public function restore(Request $request)
    {
    	$this->validate($request,[
        'id'=>'required|integer',
        'type'=>['required',
        Rule::in(['upload', 'article','comment']),],
        ]);
        $type = $_POST['type'];
        $id = $request->id;
        if($type=="article")
        {
            if (Article::onlyTrashed()->where('user_id',Auth::id())->where('id',$id)->restore()) {
                return 0;
            } else {
              return Redirect::back()->withInput()->withErrors('恢复失败');
            }
        }
        if($type=="upload")
        {
    		if (Upload::where('user_id',Auth::id())->where('id',$id)->restore()) {

	            return "123";
	        } else {
	          return Redirect::back()->withInput()->withErrors('恢复失败');
	        }
        }
        if($type=="comment")
        {
    		if (Comment::whereIn('article_id',Article::where('user_id',Auth::id())->get(['id']))->where('id',$id)->restore()) {
	            return 0;
	        } else {
	          return Redirect::back()->withInput()->withErrors('恢复失败');
	        }        	
        }
        if($type=='video')
        {
            if (Upload::where('user_id',Auth::id())->where('type','video')->where('id',$id)->restore()) {
                return 0;
            } else {
              return Redirect::back()->withInput()->withErrors('恢复失败');
            }
        }
    }
    
}
