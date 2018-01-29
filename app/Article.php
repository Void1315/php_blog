<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
 	use SoftDeletes;
    protected $fillable =['title','body','user_id'];
    protected $dates = ['deleted_at'];
    public function hasManyComments()
    {
    	return $this->hasMany('App\Comment', 'article_id', 'id');
    }
}
