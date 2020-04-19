<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Content;

class PostController extends ContentController
{
  /**
   * Shows the card for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    // FIXME: validate params
    $post = Post::find($id);
    
    if ($post == null || !$post->content->visible)
      return abort(404);

    $this->authorize('show', $post->content);

    return view('pages.posts.show', [
      'post' => $post,
      'author' => $post->content->owner,
    ]);
  }


  public function showCreateForm()
  {
    $this->authorize('create', Content::class);
    return view('pages.posts.update', ['post' => null]);
  }

  public function showEditForm($id)
  {
    $post = Post::find($id);
    $this->authorize('edit', $post->content);
    return view('pages.posts.update', ['post' => $post]);
  }

  /**
   * Creates a new post.
   *
   * @return Post The post created.
   */
  //FIXME: it is necessary to verify if the post has at least 1 category
  public function create(Request $request)
  {
    $categories = array_filter(explode(',', $request->input('categories')));

    if(empty($categories) || $request->input('title') == null || $request->input('body') == null)
      return redirect()->back()->withInput();

    $this->authorize('create', Content::class);

    $content = new Content;
    $content->author = Auth::user()->id;
    $content->body = $request->input('body');
    $content->save();
    
    $post = new Post;
    $post->id = $content->id;
    $post->title = $request->input('title');
    $post->save();

    DB::table('post_category')->where('post', $post->id)->delete();

    foreach ($categories as $category) {
      $category_id = DB::table('category')->where('title', $category)->value('id');

      DB::table('post_category')->insert(['post' => $post->id, 'category' => $category_id]);
    }

    return redirect('posts/'.$post->id);
  }

  public function edit(Request $request, $id)
  {
    $categories = array_filter(explode(',', $request->input('categories')));

    if(empty($categories) || $request->input('title') == null || $request->input('body') == null)
      return redirect()->back()->withInput();

    $post = Post::find($id);
    $this->authorize('edit', $post->content);

    DB::table('post_category')->where('post', $id)->delete();

    foreach ($categories as $category) {
      $category_id = DB::table('category')->where('title', $category)->value('id');

      DB::table('post_category')->insert(['post' => $id, 'category' => $category_id]);
    }

    $post->title = $request->input('title');
    $post->content->body = $request->input('body');
    $post->save();
    $post->content->save();

    return redirect('posts/'.$id);
  }

  public function delete($id)
  {
    $content = Content::find($id);
   
    $this->authorize('delete', $content);
    $content->delete();

    return redirect('team');
  }



  /* ================= STAR/UNSTAR ============= */

  public function star($id)
  {
    // TODO: check if post exists
    $post = Post::find($id);
    $this->authorize('star', $post);

    DB::table('star_post')->insert(['post' => $id, 'user_id' => Auth::user()->id]);

    return response()->json(['success' => 'Starred post successfully']);
  }


  public function unstar($id)
  {
    // TODO: check if post exists
    $post = Post::find($id);
    $this->authorize('star', $post);

    DB::table('star_post')->where('post', $id)->where('user_id', Auth::user()->id)->delete();

    return response()->json(['success' => 'Deleted successfully']);
  }



  /* ====================== RATING FUNCTIONS =============================*/

  public function add(Request $request, $id)
  {
    
    // TODO: check if post exists
    $content = Content::find($id);
    $this->authorize('rating', $content);

    DB::table('rating')->insert(['rating' => $request->input('type'), 'content' => $id, 'user_id' => Auth::user()->id]);   
   

    return response()->json(['success' => 'Voted successfully. Type: ' . $request->input('type') ]);
  }
  
  public function remove(Request $request, $id)
  {
    // TODO: check if post exists
    $content = Content::find($id);
    $this->authorize('rating', $content);

    DB::table('rating')->where('rating', $request->input('type'))->where('content', $id)->where('user_id', Auth::user()->id)->delete();
    
    return response()->json(['success' => 'Removed vote successfully. Type: ' . $request->input('type')]);
  }

  public function update(Request $request, $id)
  {
    // TODO: check if post exists
    $content = Content::find($id);
    $this->authorize('rating', $content);

    if( $request->input('type') == 'upvote'){
      DB::table('rating')->where('rating', 'downvote')->where('content', $id)->where('user_id', Auth::user()->id)->delete();
      DB::table('rating')->insert(['rating' => $request->input('type'), 'content' => $id, 'user_id' => Auth::user()->id]);    
    }
    else{
      DB::table('rating')->where('rating', 'upvote')->where('content', $id)->where('user_id', Auth::user()->id)->delete();
      DB::table('rating')->insert(['rating' => $request->input('type'), 'content' => $id, 'user_id' => Auth::user()->id]);
    }

    return response()->json(['success' => 'Updated vote successfully. Type: ' . $request->input('type')]);
  }
}
