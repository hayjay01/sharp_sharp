<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['user_id', 'post_id', 'videos'];
    
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
