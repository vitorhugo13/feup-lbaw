<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  public $timestamps  = false;
  protected $table = 'category';

  /*
  * posts of this category
  */
  public function posts(){
    return $this->hasMany('App\Models\Post', 'id');
  }

  /*
  * stars of a category
  */
  public function stars(){
    return $this->belongsToMany('App\Models\User');
  }

  //TODO: category glory

    
}