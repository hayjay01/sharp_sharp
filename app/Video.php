<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function post()
    {
    	# code...
    	return $this->belongsTo('App\Post');
    }
}
