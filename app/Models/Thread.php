<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

  public $timestamps  = false;
  protected $table = 'thread';

  /*
  * post of a Thread
  */
  public function threads(){
    return $this->belongsTo('App\Models\Post', 'id');
  }

  /*
  * comments of a thread
  */
  public function comments(){
      return $this->hasMany('App\Models\Comment', 'id');
  }
    
}