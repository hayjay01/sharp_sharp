<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'content', 'group_id',
    ];
    
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
