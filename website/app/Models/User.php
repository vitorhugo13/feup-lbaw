<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;


    /**
     * Model associated with table user
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role', 'release_date'
    ];

    protected $attributes = [
        'glory' => 0,
        'role' => 'Member',
        'photo' => 'storage/uploads/avatars/default.png',
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
      return $this->hasManyThrough('App\Models\Post', 'App\Models\Content', 'author', 'id', 'id', 'id');
    }

    public function getVisiblePosts() {
        return Post::join('content', 'post.id', 'content.id')
            ->where('content.author', $this->id)
            ->where('content.visible', true)
            ->select('post.id', 'post.title', 'post.num_comments')
            ->get();
    }

    /**
     * The comments this user owns.
     */
    public function comments() {
        return $this->hasManyThrough('App\Models\Comment', 'App\Models\Content', 'author', 'id', 'id', 'id');
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
        return $this->hasMany('App\Models\Rating','user_id', 'id');
    }

    /**
     * The posts this user has starred
     */
    public function starredPosts() {
        return $this->belongsToMany('App\Models\Post', 'star_post', 'user_id', 'post');
    }
    
    /**
     * The categories this user has starred
     */
    public function starredCategories() {
        return $this->belongsToMany('App\Models\Category', 'star_category', 'user_id', 'category');
    }

    /**
     * The glory this user has on each category
     */
    public function categoryGlories() {
        return $this->belongsToMany('App\Models\Category', 'category_glory', 'user_id', 'category');
    }

    /**
     * Gets the id of the report file that got the user blocked
     */
    public function getBlockReport() {
        $contents = Content::where('author', $this->id)->select('id')->get();
        return ReportFile::where('blocked', true)->where('sorted', true)->whereIn('content', $contents)->first();
    }


    public function block($date) {
        $this->update(['role' => 'Blocked', 'release_date' => $date]);
    }

    public function unblock() {
        $this->update(['role' => 'Member', 'release_date' => null]);
    }
}
