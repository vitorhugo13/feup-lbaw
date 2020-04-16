<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

  /**
   * Content uses timestamps to register creation time and last modification time
   */
  public $timestamps  = true;
  const CREATED_AT = 'creation_time';
  //TODO: it may create error because there is no updated_at
  
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
    'author', 'body',
  ];

  public function author() {
    return $this->belongsTo('App\Models\User', 'author');
  }
}
