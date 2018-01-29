<?php

namespace App\Http\Controllers\blog\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Upload;
use App;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{
    //
    public function uploadsImage(Request $request)//上传图片
    {
        $this->validate($request, [
        'file' => 'image',
            ]);
    	$admin = User::where('id',Auth::id())->first();
    	return view('admin.uplods.image')->with('admin',$admin);
    }
    public function createImage(Request $request)
    {
        $fileTypes = array('image/png','image/pjpeg','image/jpeg','image/gif',' application/octet-stream');
        $file = $request->file('file');
        if(!in_array($file->getMimeType(), $fileTypes)) {
            return '没有成功 你这都不是一个图片';
        }
        $test = App::make('creator');
        return ($test->creator('image',$request));
    }
    public function uploadVideo()
    {
        $admin = User::where('id',Auth::id())->first();
        return view('admin.uplods.video')->with('admin',$admin);
    }
    public function createVideo(Request $request)
    {
        $file = $request->file('file');
        $fileTypes = array('video/mp4','audio/x-pn-realaudio','video/x-msvideo','video/3gpp');
        if(!in_array($file->getMimeType(), $fileTypes)) {
            return '没有成功 你这都不是一个视频';
        }
        $test = App::make('creator');
        $test->creator('video',$request);
        return "成功了！";
    }
}
