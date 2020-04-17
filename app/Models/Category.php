<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  public $timestamps  = false;
  protected $table = 'category';


  public function list(){
    return Category::all()->get();
  }

  /*
  * posts of this category
  */
  public function posts(){
    return $this->belongsToMany('App\Models\Post', 'post_category', 'post', 'category');
  }

  /*
  * stars of a category
  */
  public function stars(){
    return $this->belongsToMany('App\Models\User');
  }

  //TODO: category glory

    
}