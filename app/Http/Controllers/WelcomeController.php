<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class WelcomeController extends Controller
{
    public function index(){
        $product = new Product();
        $products = $product -> all();
        $categories = Category::all();
        $sel_option = '0';
        return view('welcome', compact('products', 'categories','sel_option'));
    }
    public function productDetail(Request $request)
    {
        $product_id = $request->get('product_id');
        $product = Product::find($product_id);
        return view('productDetail',compact('product'));
    }
    public function productFilter(Request $request)
    {
        if($request->ajax())
        {
            $sel_option = $request->get('sel_option');
            $searchKey = $request->get('searchKey');
            $categories = Category::all();
            if($searchKey == '' )
            {
                if($sel_option == '0'){
                    $product = Product::all();
                    return view('ProductsPagination', array('products' => $product,'categories'=>$categories,'sel_option'=>$sel_option))->render();
                }else{
                    $product = Product::where('product_category',$sel_option)->get();
                    return view('ProductsPagination', array('products' => $product, 'categories'=>$categories,'sel_option'=>$sel_option))->render();
                }
            }
            else
            {
                if($sel_option == '0'){
                    $product = Product::where('product_name','like', '%' . $searchKey . '%' )->orWhere('description', 'like', '%' . $searchKey . '%')->get();
                    return view('ProductsPagination', array('products' => $product,'categories'=>$categories,'sel_option'=>$sel_option))->render();
                }else{
                    $product = Product::where('product_name', 'like', '%' . $searchKey . '%' )->orWhere('description', 'like', '%' . $searchKey . '%' )->where('product_category',$sel_option)->get();
                    return view('ProductsPagination', array('products' => $product,'categories'=>$categories,'sel_option'=>$sel_option))->render();
                }
            }

        }
    }
}
