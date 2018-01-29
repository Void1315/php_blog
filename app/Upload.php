<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    //
 	use SoftDeletes;
    protected $dates = ['deleted_at'];
 	protected $fillable =['path','type','user_id'];
}
