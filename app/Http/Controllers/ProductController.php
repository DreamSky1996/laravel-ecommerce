<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = new Category();
        $categories = $category->all();
        return view('backend.products', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name=$request->input('productName');
        if ($request->file('mainImage')){
            $main_image = $request->file('mainImage');
            $file_name=time().".".$main_image->getClientOriginalName();
            $destination = public_path('/product_images');
            $main_image->move($destination,$file_name);
            $product->main_image=$file_name;
        }
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->inventory = $request->input('inventory');
        if ($galleries = $request->file('galleries')){
            foreach ($galleries as $gallery){
                $gallery_name = time().".".$main_image->getClientOriginalName();
                $destination = public_path('/gallery_images');
                $gallery->move($destination, $gallery_name);
            }
        }
        $product->product_category = $request->input('category');
        $product->user_id=$request->input('user');
        $product->save();
        Session::flash('message','Product upload Successful!');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = $product->all();
        $category = new Category();
        $categories = $category->all();
        $product_id = session()->get('product_id');
        session()->remove('product_id');
        $selProduct = Product::find($product_id);
        return view('backend.product-manage', compact('products', 'categories','selProduct'));
    }

    public function updateProduct(Request $request){
        $product_id = $request->input('product_id');
        session()->put('product_id', $product_id);
        return back();
    }


    public function saveUpdatedProduct(Request $request){
        $id = $request->input('productId');
        $data = new Product();
        $data['product_name'] = $request->input('productName');
        if ($request -> file('mainImage')){
            $main_image = $request->file('mainImage');

            $file_name = time().".".$main_image->getClientOriginalName();
            $destination = public_path('/product_images');
            $main_image -> move($destination,$file_name);
            $data['main_image'] = $file_name;
        }
        $data['description'] = $request->input('description');
        $data['price'] = $request->input('price');
        $data['product_category'] = $request->input('category');
        $data['inventory'] = $request->input('inventory');
        $data['geofence'] = $request->input('geofence');
        if ($galleries = $request->file('galleries')){
            foreach ($galleries as $gallery){
                $gallery_name = time().".".$main_image->getClientOriginalName();
                $destination = public_path('/gallery_images');
                $gallery->move($destination, $gallery_name);
            }
        }
        $data['user_id'] = $request->input('user');

        if ($data['main_image'] == ''){
            $updatedData = array(
                'product_name' => $data['product_name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'product_category' => $data['product_category'],
                'inventory' => $data['inventory'],
                'geofence' => $data['geofence'],
                'user_id' => $data['user_id']
            );
        } else{
            $updatedData = array(
                'product_name' => $data['product_name'],
                'description' => $data['description'],
                'main_image' => $data['main_image'],
                'price' => $data['price'],
                'product_category' => $data['product_category'],
                'inventory' => $data['inventory'],
                'geofence' => $data['geofence'],
                'user_id' => $data['user_id']
            );
        }

        Product::whereId($id)->update($updatedData);
        return back();

    }
    public function ProductSale(Request $request)
    {
        $product_id = $request->get('product_id');
        $product = Product::whereId($product_id)->get()->first();
        $name = $product->product_name;
        $sales = DB::table('productsaletable')->where('id',$product_id)->orderBy('created_at', 'DESC')->paginate(5,['*'],'page',1);
        return view('backend.productSale',compact('sales','name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
