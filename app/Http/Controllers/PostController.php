<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Content;
use App\Models\Category;

class PostController extends Controller
{
  /**
   * Shows the card for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $post = Post::find($id);
    $content = Content::find($id);
    $user = $content->owner;

    // TODO: this can be checked in the post view
    if ($user == null) {
      $username = 'anon';
      $photo = asset('images/default_picture.png');
      $link = '';
    } else {
      $username = $user->username;
      // FIXME: this is only a temporary solution, pictures will not be in this folder
      $photo = asset('images/' . $user->photo);
      $link = '../users/' . $user->id;
    }

    // $this->authorize('show', $post);

    $starred = false;
    foreach (Auth::user()->starredPosts as $starred_post) {
      if ($starred_post->id == $id) {
        $starred = true;
        break;
      }
    }

    return view('pages.posts.show', [
      'post' => $post,
      'starred' => $starred,
      'username' => $username,
      'photo' => $photo,
      'link' => $link,
    ]);
  }


  public function showCreateForm()
  {
    return view('pages.posts.update', ['categories' => Category::orderBy('title')->get(), 'post' => null]);
  }

  public function showEditForm($id)
  {
    $post = Post::find($id);
    //$user = $post->content->owner;

    return view('pages.posts.update', ['categories' => Category::orderBy('title')->get(), 'post' => $post]);
  }

  /**
   * Creates a new post.
   *
   * @return Post The post created.
   */
  public function create(Request $request)
  {
    $post = new Post;

    $this->authorize('create', $post);

    $post->author = Auth::user()->id;

    $post->title = $request->input('title');
    $post->content->body = $request->input('body');
    $post->save();
    $post->content->save();

    return $post;
  }

  public function edit(Request $request, $id)
  {
    $post = Post::find($id);

    //$this->authorize('edit', $post);

    $categories = explode(',', $request->input('categories'));

    DB::table('post_category')->where('post', $id)->delete();

    foreach ($categories as $category) {
      $category_id = DB::table('category')->where('title', $category)->value('id');

      DB::table('post_category')->insert(['post' => $id, 'category' => $category_id]);
    }

    $post->title = $request->input('title');
    $post->content->body = $request->input('body');
    $post->save();
    $post->content->save();

    return $request;
  }

  public function delete($id)
  {
    $post = Post::find($id);

    $this->authorize('delete', $post);
    $post->delete();

    return $post;
  }


  public function star($id)
  {
    // TODO: check user authorization

    if (Auth::user() == null)
      return response()->json(['error' => 'Not authenticated'], 404);

    DB::table('star_post')->insert(['post' => $id, 'user_id' => Auth::user()->id]);

    return response()->json(['success' => 'Starred post successfully']);
  }


  public function unstar($id)
  {
    // TODO: check user authorization

    if (Auth::user() == null)
      return response()->json(['error' => 'Not authenticated'], 404);

    DB::table('star_post')->where('post', $id)->where('user_id', Auth::user()->id)->delete();

    return response()->json(['success' => 'Deleted successfully']);
  }

  public function addVote(Request $request, $id)
  {

    return response()->json(['success' => 'Vote successful']);
  }
  
  public function removeVote(Request $request, $id)
  {

    return response()->json(['success' => 'Remove vote successful']);
  }
}
