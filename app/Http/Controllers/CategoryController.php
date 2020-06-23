<?php

namespace App\Http\Controllers;

use App\Category;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $category = new Category();
        $categories = $category -> all();
        return view('backend.category', compact('categories'));
    }

    public function create(Request $request){
        $category = new Category();
        $category->category_name = $request->input('categoryName');
        $category->save();
        return back();
    }

    public function updateCategory(Request $request){
        $id = $request -> input('edit_category_id');
        $category = DB::table('categories')->where('id', $id)->first();
        return json_encode($category);
    }

    public function saveUpdatedCategory(Request $request){
        $id = $request->input('categoryId');
        $data = array(
            'category_name' => $request->categoryName
        );
        Category::whereId($id)->update($data);
        $categories = Category::all();
        return view('backend.category', compact('categories'));
    }

    public function deleteCategory(Request $request){
        $id = $request->input('delete_category_id');
        $category = Category::findOrFail($id);
        $category->delete();
        return 'success';
    }
}
