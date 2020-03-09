<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;

    protected $table = 'images';

    //relacion One to many

    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    // One to many

    public function likes(){
        return $this->hasMany('App\Like');
    }

    // many to one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
