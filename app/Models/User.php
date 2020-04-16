<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    // Specifying this model's table
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The posts this user has posted.
     */
    public function posts() {
      return $this->hasOneThrough('App\Models\Post', 'App\Models\Content', 'author', 'id', 'id', 'id');
    }

    /**
     * The comments this user owns.
     */
    public function comments() {
        return $this->hasOneThrough('App\Models\Comment', 'App\Models\Content', 'author', 'id', 'id', 'id');
      }

    /**
     * The reports a user has issued
     */
    public function reports() {
        return $this->hasMany('App\Models\Report', 'id');
    }

    /**
     * The ratings this user has made
     */
    public function ratings() {
        return $this->belongsToMany('App\Models\Content', 'id');
    }
}
