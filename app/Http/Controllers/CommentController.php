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
  public function show($id) {
    $comment = Comment::find($id);

    if($comment == null)
      return abort(404, 'No comment with id=' . $id);

    return view('partials.posts.comment', ['comment' => $comment]);
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
    } else {
      DB::table('reply')->insert(['comment' => $comment->id, 'thread' => $thread_id]);
    }

    return response()->json(['id' => $comment->id], 200);
  }

  public function edit(Request $request, $id)
  {
    
  }

  public function delete($id)
  {
    
  }
}
