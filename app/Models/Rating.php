<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

  public $timestamps  = false;
  protected $table = 'rating';

  
  public function content()
  {
    return $this->belongsTo('App\Models\Content', 'content_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }
}
