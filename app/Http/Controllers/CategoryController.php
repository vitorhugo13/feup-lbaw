<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $categories = Category::orderBy('title', 'ASC')->get();

        return view('pages.categories', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        $data = ['name' => $request->input('name')];

        $validator = Validator::make($data, [
            'name' => 'required|string|unique:category,title'
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return response()->json($errors, 400);

        $category = new Category;
        $category->title = $request->input('name');
        $category->save();

        return response()->json(['success' => 'Category added successfully', 'category' => $category], 200);
    }

    public function edit(Request $request, $id)
    {
        $data = ['name' => $request->input('name')];

        $validator = Validator::make($data, [
            'name' => 'required|string|unique:category,title'
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return response()->json($errors, 400);

        $category = Category::find($id);

        $category->title = $request->input('name');
        $category->save();

        return response()->json(['success' => 'Category name updated successfully'], 200);
    }

    public function order($criteria, $order)
    {
        return response()->json(['deck' => view('partials.categories.category_deck', ['categories' => Category::orderBy($criteria, $order)->get()])->render()]);
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