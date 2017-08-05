<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function images()
    {
    	return $this->hasMany('App\Images');
    }

    public function videos()
    {
    	return $this->hasMany('App\Video');
    }


}
