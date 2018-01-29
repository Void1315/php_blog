<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Upload;
class ImageController extends Controller
{
    //
    public function index()
    {
    	$images = Upload::where('type','image')->get();
    	return view('blog1.image')->with('images',$images);
    }
}
