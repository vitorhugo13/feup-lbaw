<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Post;
use Carbon\Carbon;

class FeedController extends Controller
{

    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $posts = Post::orderBy('num_comments', 'DESC')->get()->take(30);

        $fresh_categories = Category::orderBy('last_activity', 'DESC')->get()->take(5);
        $hot_categories = Category::get()->sortBy(function($category) { 
            return $category->num_posts + strtotime($category->last_activity); 
        })->take(5);
        $top_categories = Category::orderBy('num_posts', 'DESC')->get()->take(5);

        return view('pages.home', ['posts' => $posts, 'fresh_categories' => $fresh_categories, 'hot_categories' => $hot_categories, 'top_categories' => $top_categories]);
    }

    public function fresh()
    {
        $posts = Post::get()->sortByDesc(function($post) {
            $value = 0;
            $threads = $post->threads;
            $previous_day = strtotime(Carbon::now()) / 86400 - 1;

            foreach ($threads as $thread) {
                foreach ($thread->replies as $reply) {
                    if($previous_day < (strtotime($reply->content->creation_time) / 86400))
                    $value += strtotime($reply->content->creation_time);
                }
            }

            return $value;
        })->take(30);

        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts])->render()]);
    }

    public function hot()
    {
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => Post::all()->take(30)])->render()]);
    }

    public function top()
    {
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => Post::all()->take(30)])->render()]);
    }
}