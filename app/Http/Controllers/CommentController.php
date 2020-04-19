<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;

class CommentController extends Controller
{
  public function show(Request $request, $id) {
    $comment = Comment::find($id);

    if($comment == null)
      return abort(404, 'No comment with id=' . $id);

    return view('partials.posts.comment', ['comment' => $comment, 'thread_id' => $request->input('thread_id')]);
  }

  /**
   * Creates a new comment.
   *
   * @return Comment The comment created.
   */
  public function create(Request $request)
  {
    // $this->authorize('create', $post);
    $content = new Content;
    
    $content->author = Auth::user()->id;
    $content->body = $request->input('body');
    $content->save();
    
    $comment = new Comment;
    $comment->id = $content->id;
    $comment->save();

    // request->thread holds the thread this comment belongs to
    // if thread == -1, then this comment creates a new thread
    $thread_id = $request->input('thread');
    if($thread_id == -1){
      $thread = new Thread;
      $thread->main_comment = $comment->id;
      $thread->post = $request->input('post_id');
      $thread->save();

      $thread_id = $thread->id;
    } else {
      DB::table('reply')->insert(['comment' => $comment->id, 'thread' => $thread_id]);
    }

    return response()->json(['id' => $comment->id, 'thread_id' => $thread_id], 200);
  }

  public function edit(Request $request, $id)
  {
    $newBody = $request->input('body');
    if($newBody == null)
      return response()->json(['error' => 'Bad request'], 404);

    $comment = Content::find($id);
    if ($comment == null)
      return response()->json(['error' => 'Comment with id' . $id . ' not found'], 404);

    $comment->body = $newBody;
    $comment->save();

    return response()->json(['success' => "Edited comment successfully"], 200);
  }

  public function delete($id)
  {
    //By deleting the content with the same id as the comment,
    //the database will cascade the deletions and delete all of these:
    // comment, reply, thread (if it was main comment)
    $content = Content::find($id);

    if($content == null)
      return response()->json(['error' => 'Comment with id' . $id . ' not found'], 404);

    $content->delete();

    return response()->json(['success' => "Deleted comment successfully"], 200);
  }
}
