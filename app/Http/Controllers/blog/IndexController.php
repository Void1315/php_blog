<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Support\Collection;
use App\User;
use App\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    //
    public function show()
    {
    	# code...
    	return view('blog1.index')->with('articles',Article::where([])->orderBy('created_at','desc')->paginate(10));
    }
}
