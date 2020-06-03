<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Content
{

  public $timestamps  = false;
  protected $table = 'post';

  public function content()
  {
    return $this->belongsTo('App\Models\Content', 'id', 'id');
  }

  public function categories(){
    return $this->belongsToMany('App\Models\Category', 'post_category', 'post', 'category');
  }

  /*
  * threads of a post
  */
  public function threads(){
    return $this->hasMany('App\Models\Thread', 'post');
  }

  /*
  * stars of a post
  */
  public function stars(){
    return $this->belongsToMany('App\Models\User');
  }

  public function isVisible() {
    return DB::table('content')->where('id', $this->id)->value('visible');
  }

}
