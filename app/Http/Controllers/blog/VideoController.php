<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Upload;

class VideoController extends Controller
{
    //
    public function show()
    {
        $videos = Upload::where('type','video')->get();
    	return view('blog1.video')->with('videos',$videos);
    }
    public function play($id,Request $request)//上传文件
	{
		$video = Upload::where('id',$id)->first();
		return view('blog1.play')->with('video',$video);
	}
}
