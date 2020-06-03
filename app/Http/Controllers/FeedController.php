<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class FeedController extends Controller
{

    const PAGE_SIZE = 5;

    private function getDefaultFeedPosts(){
        $user = User::find(Auth::user()->id);
        $starred_posts = $user->starredPosts;
        $starred_categories = $user->starredCategories;

        $other_posts = Post::get()->filter(function($post) use($starred_categories){
            if($post->content->author == Auth::user()->id)
                return false;

            foreach($post->categories as $category){
                if($starred_categories->contains($category))
                    return true;
            }

            return false;
        });

        $posts = $starred_posts->merge($other_posts)->sortByDesc(function ($post) {
            return $post->content->creation_time;
        });

        return $posts;
    }

    private function getFreshPosts($page){
        $posts = Post::get()->sortByDesc(function ($post) {
            return $post->content->creation_time;
        });

        return $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'));
    }

    private function getHotPosts($page)
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

        return $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'));
    }

    private function getTopPosts($page)
    {
        $posts = Post::get()->sortByDesc(function ($post) {
            return $post->num_comments + 2 * $post->content->upvotes - $post->content->downvotes;
        });

        return $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'));
    }

    public function showFeed()
    {
        $starred_categories = Auth::user()->starredCategories->sortBy('title');
        
        $posts = $this->getDefaultFeedPosts()->take(config('constants.page-size'));

        if($posts->isEmpty())
            return view('pages.feed.empty');
        else
            return view('pages.feed.show', ['posts' => $posts, 'starred_categories' => $starred_categories]);
    }

    public function filter($selected_categories, $page){     
        $selected_categories = collect(json_decode($selected_categories));

        if($selected_categories->isEmpty())
            $posts = $this->getDefaultFeedPosts();
        else{
            $posts = Post::get()->filter(function($post) use($selected_categories){
                if($post->content->author == Auth::user()->id)
                    return false;

                foreach($post->categories as $category){
                    if($selected_categories->contains($category->id))
                        return true;
                }

                return false;
            })->sortByDesc(function ($post) {
                return $post->content->creation_time;
            });
        }

        $posts = $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'));

        if($page != 0 && $posts->isEmpty())
            return response()->json(['feed' => null]);
              
        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts])->render()]);
    }

    public function showHome()
    {
        $fresh_categories = Category::orderBy('last_activity', 'DESC')->get()->take(5);
        $hot_categories = Category::get()->sortBy(function ($category) {
            return $category->num_posts + strtotime($category->last_activity);
        })->take(5);
        $top_categories = Category::orderBy('num_posts', 'DESC')->get()->take(5);

        return view('pages.home', ['posts' => $this->getFreshPosts(0), 'fresh_categories' => $fresh_categories, 'hot_categories' => $hot_categories, 'top_categories' => $top_categories]);
    }

    public function fresh($page)
    {
        $posts = $this->getFreshPosts($page);

        if($page != 0 && $posts->isEmpty())
            return response()->json(['feed' => null]);

        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts])->render()]);
    }

    public function hot($page)
    {
        $posts = $this->getHotPosts($page);

        if($page != 0 && $posts->isEmpty())
            return response()->json(['feed' => null]);

        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts])->render()]);
    }

    public function top($page)
    {
        $posts = $this->getTopPosts($page);

        if($page != 0 && $posts->isEmpty())
            return response()->json(['feed' => null]);

        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts])->render()]);
    }
}