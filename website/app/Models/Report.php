<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  public $timestamps  = false;
  const CREATED_AT = 'time';

  protected $table = 'report';


  public function getAuthor() {
    return $this->hasOne('App\Model\User', 'id', 'author');
  }
    
}
