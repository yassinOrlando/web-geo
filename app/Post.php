<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function post(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Category');
    }
}