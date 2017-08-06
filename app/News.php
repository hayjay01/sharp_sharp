<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['user_id', 'post_id', 'files'];
    
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
