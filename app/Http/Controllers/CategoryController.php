<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends ContentController
{
    private function validateID($id)
    {
        $data = ['id' => $id];

        $validator = Validator::make($data, [
            'id' => 'required|integer|exists:category',
        ]);

        if ($validator->fails())
            return abort(404);
    }


    public function show()
    {
        $categories = Category::all();

        return view('pages.categories', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        $categories = Category::all();

        $data = ['name' => $request->input('name')];

        $validator = Validator::make($data, [
            'name' => 'required|string|unique:category,title'
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($errors);

        DB::table('category')->insert(['title' => $request->input('name')]);

        return view('pages.categories', ['categories' => $categories]);
    }


    public function star($id)
    {
        $this->validateID($id);

        $category = Category::find($id);
        //$this->authorize('star', $category);

        DB::table('star_category')->insert(['category' => $id, 'user_id' => Auth::user()->id]);

        return response()->json(['success' => 'Starred category successfully']);
    }


    public function unstar($id)
    {
        $this->validateID($id);

        $category = Category::find($id);
        //$this->authorize('star', $category);

        DB::table('star_category')->where('category', $id)->where('user_id', Auth::user()->id)->delete();

        return response()->json(['success' => 'Deleted successfully']);
    }
}