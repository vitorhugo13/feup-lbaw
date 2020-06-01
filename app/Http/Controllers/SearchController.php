<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{    
    private function text_search($username, $title, $category, $search){
        $filters_array = [];

        if($username) {
            array_push($filters_array, 'setweight(to_tsvector(\'simple\', coalesce("user".username, \'\')), \'C\')');   
        }
        if($title) {
            array_push($filters_array, 'setweight(to_tsvector(\'simple\', post.title), \'A\')');
        }
        if($category) {
            array_push($filters_array, 'setweight(to_tsvector(\'simple\', coalesce(string_agg(category.title, \' \'))), \'B\')');
        }

        $filters = implode(' || ', $filters_array);

        $results = DB::table('post')
                    ->selectRaw('post_info.id AS result_id, ts_rank(post_info.document, to_tsquery(\'simple\', ?)) AS rank', [$search])
                    ->fromRaw('(SELECT post.id AS id,' . $filters . 'as document
                                FROM post
                                JOIN content ON (post.id = content.id)
                                LEFT JOIN "user" ON (content.author = "user".id)
                                JOIN post_category ON (post.id = post_category.post)
                                JOIN category ON (post_category.category = category.id)
                                GROUP BY post.id, "user".id) AS post_info
                                WHERE post_info.document @@ to_tsquery(\'simple\', ?)
                                ORDER BY rank DESC', [$search])->pluck('result_id')->all();

        return Post::all()->whereIn('id', $results);
    }

    public function show(Request $request, $page)
    {
        $username = boolval($request->input('username', '0'));
        $title = boolval($request->input('title', '0'));
        $category = boolval($request->input('category', '0'));
        $search = str_replace(' ', ' | ', $request->input('search'));

        if(!$username && !$title && !$category) {
            $posts = $this->text_search(true, true, true, $search);
        } else {
            $posts = $this->text_search($username, $title, $category, $search);
        }

        return view('pages.search', ['search' => $search, 'flags' => [$username, $category, $title] ,'posts' => $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'))]);
    }

    public function filter(Request $request, $page){
        $username = boolval($request->input('username'));
        $title = boolval($request->input('title'));
        $category = boolval($request->input('category'));
        $search = $request->input('search');

        if(!$username && !$title && !$category) {
            $posts = $this->text_search(true, true, true, $search);
        } else {
            $posts = $this->text_search($username, $title, $category, $search);
        }

        $posts = $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'));

        if($page != 0 && $posts->isEmpty())
            return response()->json(['feed' => null]);

        return response()->json(['feed' => view('partials.posts.post_deck', ['posts' => $posts])->render()]);
    }
}