<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  public $timestamps  = false;
  protected $table = 'comment';

  public function content() {
    return $this->hasOne('App\Models\Content', 'id');
  }

  public function thread() {
    return $this->belongsTo('App\Models\Thread', 'id');
  }

  public function reply() {
    return $this->belongsTo('App\Models\Reply', 'comment');
  }
}
