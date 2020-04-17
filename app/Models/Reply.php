<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    public $timestamps  = false;
    protected $table = 'reply';

    public function thread()
    {
        return $this->belongsTo('App\Models\Thread', 'comment');
    }

    public function comment()
    {
        return $this->hasOne('App\Models\Comment', 'id');
    }
}
