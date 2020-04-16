<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  public $timestamps  = false;
  protected $table = 'post';

  /*
  * categories of a post (//TODO: hasMany(?) - pode ter só 1...)
  */
  public function categories(){
    return $this->hasMany('App\Models\Category', 'id');
  }

  /*
  * threads of a post
  */
  public function threads(){
    return $this->hasMany('App\Models\Thread', 'id');
  }

  /*
  * stars of a post
  */
  public function stars(){
    return $this->belongsToMany('App\Models\User');
  }


    
}
