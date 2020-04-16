<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  public $timestamps  = false;
  protected $table = 'comment';

  /*
  * thread of comment
  */
  public function thread(){
    return $this->belongsTo('App\Models\Thread', 'id');
  }
}
