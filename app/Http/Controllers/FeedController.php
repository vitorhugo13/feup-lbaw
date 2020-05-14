<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class FeedController extends Controller
{

    private function getDefaultFeedPosts(){
        $user = User::find(Auth::user()->id);
        $starred_posts = $user->starredPosts;

        $other_posts = Post::get()->filter(function($post){
            if($post->content->author == Auth::user()->id)
                return false;

            foreach($post->categories as $category){
                if(Auth::user()->starredCategories->contains($category))
                    return true;
            }

            return false;
        });

        $posts = $starred_posts->merge($other_posts)->sortByDesc(function ($post) {
            return $post->content->creation_time;
        });

        return $posts;
    }

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

    public function showFeed()
    {
        $starred_categories = Auth::user()->starredCategories->sortBy('title');
        
        $posts = $this->getDefaultFeedPosts();

        return view('pages.feed', ['posts' => $posts, 'starred_categories' => $starred_categories]);
    }

    public function nofilter(){
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $this->getDefaultFeedPosts()->take(30)])->render()]);
    }

    public function filter($selected_categories){     
        $selected_categories = collect($selected_categories);
        
        $posts = Post::get()->filter(function($post) use($selected_categories){
            if($post->content->author == Auth::user()->id)
            return false;

            foreach($post->categories as $category){
                if($selected_categories->contains($category))
                    return true;
            }

            return false;
        });
              
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts->take(30)])->render()]);
    }

    public function showHome()
    {
        $fresh_categories = Category::orderBy('last_activity', 'DESC')->get()->take(5);
        $hot_categories = Category::get()->sortBy(function ($category) {
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