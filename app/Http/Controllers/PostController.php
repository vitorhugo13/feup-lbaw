<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class CardController extends Controller
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

      $this->authorize('show', $post);

      return view('pages.posts.show', ['post' => $post]);
    }

    /**
     * Shows all cards.
     *
     * @return Response
     */
    // public function list()
    // {
    //   if (!Auth::check()) return redirect('/login');

    //   $this->authorize('list', Card::class);

    //   $cards = Auth::user()->cards()->orderBy('id')->get();

    //   return view('pages.cards', ['cards' => $cards]);
    // }

    /**
     * Creates a new card.
     *
     * @return Card The card created.
     */
    public function create(Request $request)
    {
      $post = new Post();

      $this->authorize('create', $post);

      $post->author = Auth::user()->id;
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();

      return $post;
    }

    public function delete(Request $request, $id)
    {
      $post = Post::find($id);

      $this->authorize('delete', $post);
      $post->delete();

      return $post;
    }
}
