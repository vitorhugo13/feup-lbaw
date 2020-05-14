<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;

use App\Notifications\NewComment;


class CommentController extends ContentController
{
  private function validateID($id)
  {
    $data = ['id' => $id];

    $validator = Validator::make($data, [
      'id' => 'required|integer|exists:comment',
    ]);

    if ($validator->fails())
      return abort(404, 'No comment with id ' . $id);
  }

  public function show(Request $request, $id) {
    $this->validateID($id);

    $comment = Comment::find($id);

    $username = $request->input('author_name');

    $author = $username == 'anon' ? null : User::where('username', $username)->first();

    $this->authorize('show', $comment->content);

    return view('partials.comment.comment', ['comment' => $comment, 'thread_id' => $request->input('thread_id'), 'author' => $author]);
  }

  /**
   * Creates a new comment.
   *
   * @return Comment The comment created.
   */
  public function create(Request $request)
  {
    // $validator = Validator::make($request, [
    //   'body' => 'required|string',
    // ]);

    // if ($validator->fails())
    //   return response()->json(['error' => 'Body is empty'], 404);

    $post = Post::find($request->input('post_id'));   // posts where the comment was made
      
    $this->authorize('create', Content::class);
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

      // notify the owner of the main comment
      $main_comment = Thread::find($thread_id)->comment;
      //if ($main_comment->content->tracking && $main_comment->content->author != Auth::user()->id)
        //$main_comment->content->owner->notify(new NewComment($post->id, Auth::user()->id, $comment->id));
    }

    // notify the author
    //if ($post->content->tracking && $post->content->author != Auth::user()->id)
      //$post->content->owner->notify(new NewComment($post->id, Auth::user()->id, $comment->id));

    return response()->json(['id' => $comment->id, 'thread_id' => $thread_id], 200);
  }

  public function edit(Request $request, $id)
  {
    $newBody = $request->input('body');
    if ($newBody == null)
      return response()->json(['error' => 'Bad request'], 404);
    
    $comment = Content::find($id);
    $this->authorize('edit', $comment);
    if ($comment == null)
      return response()->json(['error' => 'Comment with id' . $id . ' not found'], 404);

    $comment->body = $newBody;
    $comment->save();

    return response()->json(['success' => "Edited comment successfully"], 200);
  }

  public function delete($id)
  {
    $data = ['id' => $id];

    $validator = Validator::make($data, [
      'id' => 'required|integer|exists:comment',
    ]);

    if ($validator->fails())
      return response()->json(['error' => 'Comment with id' . $id . ' not found'], 404);

    //By deleting the content with the same id as the comment,
    //the database will cascade the deletions and delete all of these:
    // comment, reply, thread (if it was main comment)
    $content = Content::find($id);

    if($content == null)
      return response()->json(['error' => 'Comment with id' . $id . ' not found'], 404);

    $this->authorize('delete', $content);

    $thread = Thread::where('main_comment', $id)->first();
    if($thread == null) {
      $reply = DB::table('reply')->where('comment', $id)->first();
      $thread = Thread::where('id', $reply->thread)->first();
    }
    
    $post_id = $thread->post; 
    $content->delete();
    $numComments = Post::find($post_id)->num_comments;    

    return response()->json(['success' => "Deleted comment successfully", 'num' => $numComments], 200);
  }
}
