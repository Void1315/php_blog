<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\User;
use App\Tourist;
use App;
use Illuminate\Validation\Rule;

class SingleController extends Controller
{
    //

    public function show($id,Request $request)
    {
        $judgeTime = App::make('creator');

        $tourists = $judgeTime->isData(false,$request);/*返回0/1 或者大于1*/

    	return view('blog1.single')->with('article',Article::where('id',$id)->first())->with('tourists',$tourists);
    }
    public function oppost(Request $request)
    {

    	$this->validate($request,
    		['id'=>'required|integer',
    		'type'=>['required',
    		Rule::in([0, 1]),
    			],
    		]);
    	
        $judgeTime = App::make('creator');
        if(!$judgeTime->opinion($request))
        {
            return "无法重复执行";
        }

    	$article = Article::where('id',$id)->first();
    	$type = $request->type;
    	if($type ==1)
    	{
    		$article->support = $article->support+1;
    	}
    	else if($type ==0)
    	{
    		$article->opposition = $article->Opposition+1;
    	}
    	$article->save();
    }
}
