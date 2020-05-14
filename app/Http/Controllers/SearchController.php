<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function show()
    {
        $user = User::find(Auth::user()->id);
        $posts = $user->starredPosts->sortByDesc(function ($post) {
            return $post->content->creation_time;
        })->take(30);

        return view('pages.search', ['posts' => $posts]);
    }
}