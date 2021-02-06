<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comment extends Content
{

  public $timestamps  = false;
  protected $table = 'comment';

  public function content() {
    return $this->belongsTo('App\Models\Content', 'id', 'id');
  }

  public function getPostId() {
    $reply = DB::table('reply')->where('comment', $this->id)->first();
    
    if ($reply === null)
      $thread = Thread::where('main_comment', $this->id)->first();
    else
      $thread = Thread::find($reply->thread);

    return $thread->post;
  }
}
