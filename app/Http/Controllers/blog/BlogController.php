<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    //
    public function show()//博客主页
    {
    	return view('blog1.full')->with('articles',Article::where([])->orderBy('created_at','desc')->paginate(25))->with('user',User::find(1));
    }
}
