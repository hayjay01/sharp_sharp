<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['category_id', 'title', 'details', 'slug', 'user_id', 'admin_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function members()
    {
        return $this->hasMany('App\Member');
    }

    public function is_already_joined()
    {
        $id = Auth::user()->id;

        $membs = array();

        foreach($this->members as $member)
        {
            array_push($membs, $member->user_id);
        }
        
        if(in_array($id, $membs))
        {
            return TRUE;
        }else 
        {
            return FALSE;
        }
    }
}
