<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Contest;
use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Support\Facades\Validator;


class ReportController extends ContentController
{

    public function show() {
        return view('pages.reports');
    }

    public function getPosts() {

        $reports = ReportFile::join('post', 'content', 'post.id')
            ->select('report_file.id', 'post.title')
            ->get();

        foreach ($reports as $report) {
            $data = Report::where('file', $report['id']);
            
            foreach ($data->select('reason')->get() as $reason) {
                $reasons = $reason['reason'] . ', ';
            }

            $report['reason'] = $reasons;
            $report['date'] = $data->select('time')->get()->max()['time'];
        }

        return response()->json(['success' => 'Retrieved post reports.', 'reports' => $reports], 200);
    }
    
    public function getComments()
    {
        $reports = ReportFile::join('comment', 'content', 'comment.id')
            ->select('report_file.id')
            ->get();

        foreach ($reports as $report) {
            $data = Report::where('file', $report['id']);
            
            foreach ($data->select('reason')->get() as $reason) {
                $reasons = $reason['reason'] . ', ';
            }

            $comment_id = ReportFile::find($report['id'])->content;
            $report['content'] = Content::find($comment_id)->body;
            $report['reason'] = $reasons;
            $report['date'] = $data->select('time')->get()->max()['time'];
        }
        
        return response()->json(['success' => 'Retrieved comment reports.', 'reports' => $reports], 200);
    }

    public function getContests()
    {

        $contests = ReportFile::join('contest', 'report_file.id', 'contest.report')
            ->where('report_file.sorted', false)
            ->select('report_file.id', 'contest.justification', 'contest.time')
            ->get();

        foreach ($contests as $report) {
            $data = Report::where('file', $report['id']);

            foreach ($data->select('reason')->get() as $reason) {
                $reasons = $reason['reason'] . ', ';
            }

            $report['reason'] = $reasons;
        }

        return response()->json(['success' => 'Retrieved report contests.', 'contests' => $contests], 200);
    }

    // TODO: create a new report
    public function createReport(Request $request) {

        // author, content, reason

        // authorize

        // check if a report file for the content already exists
        // if it does not exists
            // create a new report file
            // get its id
        // else
            // get the report file id

        // create a new report
        
        // alert message
        // respond
    }

    // TODO: delete a report
    public function deleteReport($id) {

    }

    // TODO: sort a report
    public function sortReport($id, $decision) {

    }

    // CONTESTS

    public function getBlockReasons() {
        $report = Auth::user()->getBlockReport();

        $reasons_array = $report->getReasons();
        $reasons = $reasons_array[0];
        for ($i = 1; $i < count($reasons_array); $i++)
            $reasons = $reasons . ', ' . $reasons_array[$i];

        return response()->json(['success' => 'Retrieved reasons', 'reasons' => $reasons, 'report' => $report->id], 200);
    }

    // TODO: contest a report
    public function contestReport($id, Request $request) {
        
        $user = $request['user_id'];
        $justification = $request['justification'];

        // authorize

        $contest = new Contest;
        $contest->justification = $justification;
        $contest->report = $id;
        $contest->save();

        ReportFile::find($id)->update(['sorted' => false]);

        return response()->json(['success' => 'Contest successfuly created.'], 200);
    }

    // TODO: sort a contest
    public function sortContest($id, $decision) {

    }
}
