<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Content;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class PostController extends ContentController
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

    private function updateCategories($categoriesList, $post_id) {
        $categories = array_filter(explode(',', $categoriesList));

        DB::table('post_category')->where('post', $post_id)->delete();

        foreach ($categories as $category) {
            $category_id = DB::table('category')->where('title', $category)->value('id');

            DB::table('post_category')->insert(['post' => $post_id, 'category' => $category_id]);
        }
    }

    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->validateID($id);

        $post = Post::find($id);

        if (!$post->content->visible)
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

        if (Auth::user()->role != 'Administrator')
            $categories = Category::orderBy('title')->get()->where('title', '!=', 'Community News');
        else
            $categories = Category::orderBy('title')->get();

        return view('pages.posts.update', ['post' => null, 'categories' => $categories]);
    }

    public function showEditForm($id)
    {
        $this->validateID($id);

        if (Auth::user()->role != 'Administrator')
            $categories = Category::orderBy('title')->get()->where('title', '!=', 'Community News');
        else
            $categories = Category::orderBy('title')->get();

        $post = Post::find($id);
        $this->authorize('edit', $post->content);

        return view('pages.posts.update', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Creates a new post.
     *
     * @return Post The post created.
     */

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
            'categories' => 'required|string'
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($errors);

        $this->authorize('create', Content::class);

        $content = new Content;
        $content->author = Auth::user()->id;
        $content->body = $request->input('body');
        $content->save();

        $post = new Post;
        $post->id = $content->id;
        $post->title = $request->input('title');
        $post->save();

        $this->updateCategories($request->input('categories'), $post->id);

        // $request->session()->flash('alert-success', "Posted with success!");
        return redirect('posts/' . $post->id)->with('alert-success', "Post successfully created!");
    }

    public function edit(Request $request, $id)
    {
        $this->validateID($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
            'categories' => 'required|string'
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($errors);

        $post = Post::find($id);
        $this->authorize('edit', $post->content);

        $this->updateCategories($request->input('categories'), $id);

        $post->title = $request->input('title');
        $post->content->body = $request->input('body');
        $post->save();
        $post->content->save();

        return redirect('posts/' . $id)->with('alert-success', "Post successfully updated!");
    }

    public function delete($id)
    {
        $content = Content::find($id);
        Rating::where('content', $id)->delete();
    
        $this->authorize('delete', $content);

        $content->delete();

        return redirect('users/' . Auth::user()->id)->with('alert-success', "Post successfully deleted!");
    }

    /* ================= STAR/UNSTAR ============= */

    public function star($id)
    {
        $this->validateID($id);

        $post = Post::find($id);
        $this->authorize('star', $post);

        DB::table('star_post')->insert(['post' => $id, 'user_id' => Auth::user()->id]);

        return response()->json(['success' => 'Starred post successfully']);
    }


    public function unstar($id)
    {
        $this->validateID($id);
        $post = Post::find($id);
        $this->authorize('star', $post);

        DB::table('star_post')->where('post', $id)->where('user_id', Auth::user()->id)->delete();

        return response()->json(['success' => 'Deleted successfully']);
    }

    /* ================= CATEGORIES ============= */

    public function move(Request $request, $id)
    {
        $this->validateID($id);

        $validator = Validator::make($request->all(), [
            'categories' => 'required|string'
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return response()->json($errors, 400);

        $this->updateCategories($request->input('categories'), $id);

        return response()->json(['success' => 'Updated categories successfully'], 200);
    }
}
