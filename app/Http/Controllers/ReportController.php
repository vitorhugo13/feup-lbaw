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
        $this->authorize('show', ReportFile::class);
        return view('pages.reports');
    }

    public function getPosts() {
        $reports = ReportFile::join('post', 'content', 'post.id')
            ->select('report_file.id', 'report_file.content', 'post.title')
            ->get();

        foreach ($reports as $report) {
            $file = ReportFile::find($report->id);
            $report['reason'] = implode(', ', $file->getReasons());
            $report['date'] = $file->getTimestamp();
        }

        return response()->json(['success' => 'Retrieved post reports.', 'reports' => $reports], 200);
    }
    
    public function getComments() {
        $reports = ReportFile::join('comment', 'content', 'comment.id')
            ->select('report_file.id', 'report_file.content')
            ->get();

        foreach ($reports as $report) {
            $file = ReportFile::find($report->id);
            $comment = Comment::find($file->content);

            $report['post'] = $comment->getPostId();
            $report['content'] = $comment->content->body;
            $report['reason'] = implode(', ', $file->getReasons());
            $report['date'] = $file->getTimestamp();
        }
        
        return response()->json(['success' => 'Retrieved comment reports.', 'reports' => $reports], 200);
    }

    public function getContests() {
        $contests = ReportFile::join('contest', 'report_file.id', 'contest.report')
            ->where('report_file.sorted', false)
            ->select('report_file.id', 'contest.justification', 'contest.time')
            ->get();

        foreach ($contests as $report) {
            $file = ReportFile::find($report->id);
            $report['reason'] = implode(', ', $file->getReasons());
        }

        return response()->json(['success' => 'Retrieved report contests.', 'contests' => $contests], 200);
    }

    public function createReport(Request $request) {
        
        $author = Auth::user()->id;         // id of the author
        $content = $request['content'];     // id of the content
        $reason = $request['reason'];       // string with reason

        $this->authorize('createReport', ReportFile::class);

        $file = ReportFile::where('content', $content)->first();
        if ($file === null) {
            $file = new ReportFile;
            $file->content = $content;
            $file->save();
        }

        $report = new Report;
        $report->file = $file->id;
        $report->author = $author;
        $report->reason = $reason;
        $report->save();

        return response()->json(['success' => 'Report successfuly submited.'], 200);
    }

    public function deleteReport($id) {
        $report = ReportFile::find($id);

        // FIXME: the return code might be wrong here
        if ($report === null)
            return response()->json(['error' => 'Report not found.'], 404);
        
        $this->authorize('deleteReport', ReportFile::class);

        $report->delete();
        return response()->json(['success' => 'Report successfuly deleted.'], 200);
    }

    public function sortReport($id) {
        $report = ReportFile::find($id);

        // FIXME: the return code might be wrong here
        if ($report === null)
            return response()->json(['error' => 'Report not found.'], 404);

        $this->authorize('sortReport', ReportFile::class);

        $report->update(['sorted' => true]);
        return response()->json(['success' => 'Report successfuly resolved.']);
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

    public function contestReport($id, Request $request) {
        // $user = $request['user_id'];
        $justification = $request['justification'];

        $this->authorize('contestReport', ReportFile::class);

        $contest = new Contest;
        $contest->justification = $justification;
        $contest->report = $id;
        $contest->save();

        ReportFile::find($id)->update(['sorted' => false]);

        return response()->json(['success' => 'Contest successfuly created.'], 200);
    }

    public function sortContest($id) {
        $this->authorize('sortContest', ReportFile::class);

        $report = ReportFile::find($id);
        if ($report === null)
            return response()->json(['error' => 'Report file not found.'], 404);
        
        $content = Content::find($report->content);
        if ($content === null)
            return response()->json(['error' => 'Content not found.'], 404);
        
        if ($content->owner === null)
            return response()->json(['error' => 'Content author not found.'], 404);
        
        $content->owner->unblock();
        $content->update(['visible' => true]);
        $report->delete();

        return response()->json(['success' => 'Contest sorted.'], 200);
    }

}
