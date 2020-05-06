<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Post;
use Carbon\Carbon;

class FeedController extends Controller
{

    private function getFreshPosts(){
        $posts = Post::get()->sortByDesc(function ($post) {
            return $post->content->creation_time;
        });

        return $posts->take(30);
    }

    private function getHotPosts()
    {
        $posts = Post::get()->sortByDesc(function ($post) {
            $value = $post->num_comments;
            $threads = $post->threads;
            $previous_day = strtotime(Carbon::now()) / 86400 - 2;

            if($previous_day - 1 < (strtotime($post->content->creation_time) / 86400)){
                foreach ($threads as $thread) {
                    foreach ($thread->replies as $reply) {
                        if ($previous_day < (strtotime($reply->content->creation_time) / 86400))
                            $value += $reply->content->upvotes + $reply->content->downvotes;
                    }
                }
            }

            return $value;
        });

        return $posts->take(30);
    }

    private function getTopPosts()
    {
        $posts = Post::get()->sortByDesc(function ($post) {
            return $post->num_comments + 2 * $post->content->upvotes - $post->content->downvotes;
        });

        return $posts->take(30);
    }

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
        })->take(5); //TODO: Probably change this criteria
        $top_categories = Category::orderBy('num_posts', 'DESC')->get()->take(5);

        return view('pages.home', ['posts' => $this->getFreshPosts(), 'fresh_categories' => $fresh_categories, 'hot_categories' => $hot_categories, 'top_categories' => $top_categories]);
    }

    public function fresh()
    {
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $this->getFreshPosts()])->render()]);
    }

    public function hot()
    {
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $this->getHotPosts()])->render()]);
    }

    public function top()
    {
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $this->getTopPosts()])->render()]);
    }
}