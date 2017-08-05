<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function post()
    {
    	# code...
    	return $this->belongsTo('App\Post');
    }
}
