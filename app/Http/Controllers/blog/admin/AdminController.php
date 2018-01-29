<?php

namespace App\Http\Controllers\blog\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Article;
use App\Upload;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
class AdminController extends Controller
{
    public function show()//展示主页
    {
    	return view('admin.admin')->with('admin',User::where('id',Auth::id())->first());
    }
    public function alterData()//修改个人资料
    {
    	return view('admin.data')->with('admin',User::where('id',Auth::id())->first());
    }
    public function changeData(Request $request)//改变
    {
    	$this->validate($request, [
		        'name' => 'required|max:16',
		        'email'=>'email|required',
		        'telphone'=>'required',
		        'introduction'=>'required|max:70',
                'image'=>'required|dimensions:min_width=160,min_height=160',
		    ]);
        $file = $request->file('image');
        $extension = $request->image->getClientOriginalExtension();
        $path = $file->storeAs('img/'.Auth::id(),'user-medium.'.$extension);
		if (User::where('id',Auth::id())->update(Input::except('_token','image'))) {
            $rua = User::where('id',Auth::id())->first();
            $rua->image = $path;
            $rua->save();
     		return Redirect::back();
	    } else {
	      return Redirect::back()->withInput()->withErrors('修改失败');
	    }
    }
    public function words()
    {
        return view('admin.word')->with('admin',User::where('id',Auth::id())->first());
    }
    public function wordsSubmit(Request $request)//文章提交
    {
        $data = Input::all();
        $this->validate($request, [
            'title'=>'required|max:30',
            'body'=>'required|min:6',

            ]);
        $data['user_id'] = Auth::id();
        if (Article::create($data)) {
            return '发布成功';
        } else {
          return Redirect::back()->withInput()->withErrors('文章发布失败！');
        }
    }
    public function manageWord()//文章管理
    {   
        // $articles = User::where('id',Auth::id())->first()->hasManyArticles[0]->paginate(10);
        $articles =Article::where('user_id',Auth::id())->paginate(10);
        return view('admin.manage.word')->with('articles',$articles)->with('admin',User::where('id',Auth::id())->first());
    }
    public function upWord()//大小排序
    {
        $articles = User::where('id',Auth::id())->first()->hasManyArticles->sortByDesc('updated_at')[0]->paginate(10);
        return view('admin.manage.word')->with('articles',$articles)->with('admin',User::where('id',Auth::id())->first());
    }
    public function changeWord($id)
    {
        return view('admin.words')->with('article',Article::where('id',$id)->first())->with('admin',User::where('id',Auth::id())->first());
    }
    public function updataWord(Request $request)//更新文章
    {
        $this->validate($request, [
        'title'=>'required|max:30',
        'body'=>'required|min:12',
        'id'=>'required|integer',
        ]);
        if (Article::where('id',Input::get('id'))->update(Input::except('_token','id'))) {
            return Redirect::back();
        } else {
          return Redirect::back()->withInput()->withErrors('修改失败');
        }
    }
    public function deleteWord(Request $request)//删除文章
    {
        $this->validate($request,[
            'id'=>'required|integer',
            ]);
        if (Article::where('id',Input::get('id'))->delete()) {
            return redirect('admin/manage/word');
        } else {
          return Redirect::back()->withInput()->withErrors('删除失败');
        }

    }
    public function deleteImage(Request $request)
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
    public function out()//退出登录
    {
        Auth::logout();
        return Redirect::back();
    }
}
