<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Content
{

  public $timestamps  = false;
  protected $table = 'comment';

  public function content() {
    return $this->belongsTo('App\Models\Content', 'id', 'id');
  }
}
