<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

  /**
   * Content uses timestamps to register creation time and last modification time
   */
  public $timestamps  = false;
  const CREATED_AT = 'creation_time';
  
  /**
    * Model associated with table content
    * 
    * @var string
    */
  protected $table = 'content';

  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
  protected $fillable = [
    'author', 'body', 'visible'
  ];

  public function owner() {
    return $this->belongsTo('App\Models\User', 'author');
  }

  /**
     * The ratings this user has made
     */
  public function ratings() {
      return $this->belongsToMany('App\Models\Rating', 'rating', 'id', 'content_id');
  }

}
