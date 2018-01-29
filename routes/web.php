<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'blog\IndexController@show');//主页
Route::get('/blog','blog\BlogController@show');//博客
Route::get('/video','blog\VideoController@show');//视频
Route::get('/video/{id}','blog\VideoController@play');//视频具体
//Route::get('/contact','blog\ContactController@show');//
Route::get('/article/{id}','blog\SingleController@show');//文章具体展示
Route::get('/image','blog\ImageController@index');//图片展示

Route::get('/test','TestController@index');

Route::get('/comment/article/{id}','blog\CommentsController@articleComment');//评论获取

Route::post('/create/comment/article','blog\CommentsController@createArticleComment');//发表评论

Route::post('/article/oppost','blog\SingleController@oppost');

Auth::routes();
Route::group(['middleware' => 'web','middleware' => 'auth','prefix'=>'admin','namespace' => 'blog\admin'],function()
{

	Route::get('/out','AdminController@out');//退出

	Route::get('/','AdminController@show');//后台主页
	Route::get('/config','AdminController@alterData');//修改个人资料
	Route::get('/words','AdminController@words');//发布文章
	Route::get('/manage/word','AdminController@manageWord');//管理文章

	Route::get('/words/{id}','AdminController@changeWord');//修改文章的提交

	Route::get('/uploads/image','UploadController@uploadsImage');//上传图片

	Route::get('/manage/image','ManageController@manageImage');//管理图片

	Route::get('/manage/video','ManageController@manageVideo');//管理视频

	Route::get('/manage/comments','ManageController@manageComments');//管理评论

	Route::get('/manage/comments/up','ManageController@upComments');//评论排序

	Route::get('/trash','TrashController@show');//回收站展示

	Route::get('/manage/word/up','AdminController@upWord');

	Route::get('/uploads/video','UploadController@uploadVideo');//上传视频
	Route::post('/create/image','UploadController@createImage');//创建图片
	Route::post('/words/submit','AdminController@wordsSubmit');//创建文章
	Route::post('/word/updata','AdminController@updataWord');//更新文章
	Route::post('/config/change','AdminController@changeData');//改变资料
	Route::post('/delete/word','AdminController@deleteWord');//删除文章
	Route::post('/delete/image','AdminController@deleteImage');//删除图片
	Route::post('/delete/comments','ManageController@deleteComment');//删除评论
	Route::post('/restore','TrashController@restore');//回收站展示
	Route::post('create/video','UploadController@createVideo');//创建视频
	Route::post('/delete/video','ManageController@deleteVideo');//删除视频
	Route::post('/manage/video/change/','ManageController@videoName');//改变视频

	Route::post('/kill/upload','TrashController@killUpload');//永久删除
	Route::post('/kill/comment','TrashController@killComment');
	Route::post('kill/article','TrashController@killArticle');
});
