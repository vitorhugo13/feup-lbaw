<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    public $timestamps  = false;
    const CREATED_AT = 'time';

    protected $table = 'contest';
}
