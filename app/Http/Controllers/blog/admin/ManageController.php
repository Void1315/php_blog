<?php

namespace App\Http\Controllers\blog\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Upload;
use App\Comment;
use App\Article;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    public function manageImage()//图片管理
    {
    	$id = User::where('id',Auth::id())->first();
    	$images = User::where('id',Auth::id())->first()->hasManyUploads->where('type','image');
    	return view('admin.manage.image')->with('admin',$id)->with('images',$images);
    }
    public function manageComments()/*管理评论*/
    {
    	$id = User::where('id',Auth::id())->first();
		// $comments  = Comment::whereIn('article_id',Article::where('user_id',Auth::id())->get(['id']))->get();
        $comments = DB::table('articles')
        ->join('comments', 'articles.id', '=', 'comments.article_id')
        ->select('comments.*', 'articles.title')->whereNull('comments.deleted_at')->where('articles.user_id',Auth::id())
        ->simplePaginate(15);
		return view('admin.manage.comments')->with('admin',$id)->with('comments',$comments);

    }
    public function upComments()//排序评论
    {
        $id = User::where('id',Auth::id())->first();
        $comments  = Comment::whereIn('article_id',Article::where('user_id',Auth::id())->get(['id']))->get();
        $comments = DB::table('articles')
        ->join('comments', 'articles.id', '=', 'comments.article_id')
        ->select('comments.*', 'articles.title')->whereNull('comments.deleted_at')->orderBy('updated_at', 'desc')
        ->simplePaginate(15);
        return view('admin.manage.comments')->with('admin',$id)->with('comments',$comments);
    }
    public function deleteComment(Request $request)//删除评论
    {
    	$this->validate($request,[
            'id'=>'required|integer',
            ]);
    	if (Article::where('user_id',Auth::id())->count()>0&&Comment::where('id',Input::get('id'))->delete()) {
            return 0;
        } else {
          return Redirect::back()->withInput()->withErrors('删除失败');
        }
    }
    public function manageVideo(Request $request)//视频管理
    {
        $id = User::where('id',Auth::id())->first();
        $videos = Upload::where('type','video')->where('user_id',Auth::id())->simplePaginate(5);
        return view('admin.manage.video')->with('admin',$id)->with('videos',$videos);
    }
    public function videoName(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:45|string',
            'id'=>'required|integer',
            ]);
        $id = $request->id;
        $video = Upload::where('id',$id)->first();
        $video->name = $request->name;
        $video->save();
        return 0;
    }
    public function deleteVideo(Request $request)//删除视频
    {
        $this->validate($request,[
        'id'=>'required|integer',
        ]);
        if (Upload::where('id',Input::get('id'))->delete()) {
            return 0;
        } else {
          return Redirect::back()->withInput()->withErrors('删除失败');
        }

    }
}
