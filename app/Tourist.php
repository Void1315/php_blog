<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    //
    public $primaryKey = 'ip';
    public $timestamps = false;
    protected $fillable  = ['ip','s_article_id','opinion'];//*一次更新这两个字段*/
}
