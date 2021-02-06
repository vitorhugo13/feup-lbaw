<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Content;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{

    private function validateID($id)
    {
        $data = ['id' => $id];

        $validator = Validator::make($data, [
            'id' => 'required|integer|exists:content',
        ]);

        if ($validator->fails())
            return abort(404);
    }


    // =======================================================================
    // ======================== RATING FUNCTIONS =============================
    // =======================================================================

    public function add(Request $request, $id)
    {
        $this->validateID($id);
        $content = Content::find($id);
        $this->authorize('rating', $content);

        DB::table('rating')->insert(['rating' => $request->input('type'), 'content' => $id, 'user_id' => Auth::user()->id]);
        return response()->json(['success' => 'Voted successfully. Type: ' . $request->input('type')]);
    }

    public function remove(Request $request, $id)
    {
        $this->validateID($id);

        $content = Content::find($id);
        $this->authorize('rating', $content);

        DB::table('rating')->where('rating', $request->input('type'))->where('content', $id)->where('user_id', Auth::user()->id)->delete();

        return response()->json(['success' => 'Removed vote successfully. Type: ' . $request->input('type')]);
    }

    public function update(Request $request, $id)
    {
        $this->validateID($id);

        $content = Content::find($id);
        $this->authorize('rating', $content);

        DB::transaction(function() use ($request, $id) {
            if ($request->input('type') == 'upvote') {            
                DB::table('rating')->where('rating', 'downvote')->where('content', $id)->where('user_id', Auth::user()->id)->delete();
                DB::table('rating')->insert(['rating' => $request->input('type'), 'content' => $id, 'user_id' => Auth::user()->id]);
            } else {
                DB::table('rating')->where('rating', 'upvote')->where('content', $id)->where('user_id', Auth::user()->id)->delete();
                DB::table('rating')->insert(['rating' => $request->input('type'), 'content' => $id, 'user_id' => Auth::user()->id]);
            }
        });

        return response()->json(['success' => 'Updated vote successfully. Type: ' . $request->input('type')]);
    }


    public function hide($id)
    {
        $content = Content::find($id);
        if ($content === null)
            return response()->json(['error' => 'Content not found.'], 404);

        $this->authorize('hide', Content::class);
        $content->update(['visible' => false]);

        return response()->json(['success' => 'Content hidden.'], 200);
    }
}
