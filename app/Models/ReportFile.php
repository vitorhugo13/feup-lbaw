<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    public $timestamps = false;
    
    protected $table = 'report_file';
    protected $fillable = ['sorted'];

    public function getContent() {
        return $this->hasOne('App\Models\Content', 'id', 'content');
    }

    public function getReviewer() {
        return $this->hasOne('App\Models\User', 'id', 'reviewer');
    }

    public function getReports() {
        return $this->hasMany('App\Models\Report', 'file', 'id');
    }
}
