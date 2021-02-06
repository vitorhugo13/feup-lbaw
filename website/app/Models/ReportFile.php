<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getReasons() {
        $reports = Report::where('file', $this->id)->get();

        $reasons = array();
        foreach ($reports as $report) {
            array_push($reasons, $report['reason']);
        }
        $reasons = array_unique($reasons, SORT_STRING);
        
        return $reasons;
    }

    public function getTimestamp() {
        return Report::where('file', $this->id)->select('time')->get()->max()['time'];
    }
}
