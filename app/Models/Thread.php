<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

  public $timestamps  = false;
  protected $table = 'thread';

  /*
  * main comment of a Thread
  */
  public function comment(){  
      return $this->hasOne('App\Models\Comment', 'id', 'main_comment');
  }

  /*
  * replys to the comment of a Thread
  */
  public function replies() {
    return $this->belongsToMany('App\Models\Comment', 'reply', 'thread', 'comment');

  }
}