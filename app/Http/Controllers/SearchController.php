<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{

    private function text_search($search){
        $query = str_replace(' ', ' | ', $search);

        error_log($query);
        $results = DB::table('post')
                    ->selectRaw('post_info.id AS result_id, ts_rank(post_info.document, to_tsquery(\'english\', ?)) AS rank', [$query])
                    ->fromRaw('(SELECT post.id AS id,
                                setweight(to_tsvector(\'english\', post.title), \'A\') ||
                                setweight(to_tsvector(\'simple\', coalesce("user".username, \'\')), \'C\') ||
                                setweight(to_tsvector(\'english\', coalesce(string_agg(category.title, \' \'))), \'B\') as document
                                FROM post
                                JOIN content ON (post.id = content.id)
                                LEFT JOIN "user" ON (content.author = "user".id)
                                JOIN post_category ON (post.id = post_category.post)
                                JOIN category ON (post_category.category = category.id)
                                GROUP BY post.id, "user".id) AS post_info
                                WHERE post_info.document @@ to_tsquery(\'english\', ?)
                                ORDER BY rank DESC', [$query])->pluck('result_id')->all();

        return Post::all()->whereIn('id', $results);
    }

    public function show(Request $request, $page)
    {
        $posts = $this->text_search($request->input('search'));

        return view('pages.search', ['posts' => $posts->slice($page * config('constants.page-size'))->take(config('constants.page-size'))]);
    }

    public function filter(Request $request, $page){
        
    }
}