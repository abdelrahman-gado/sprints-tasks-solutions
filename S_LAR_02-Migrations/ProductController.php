<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(Product::PAGINATION_COUNT);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('admin.products.create', compact('sizes', 'colors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::$createRules);

        $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);
        $product = new Product();
        $product->fill($request->post());
        $product['discount'] = $request['discount'] / 100;
        $product['image'] = $imageUrl;
        $product['is_recent'] = isset($request['is_recent']) ? 1 : 0;
        $product['is_featured'] = isset($request['is_featured']) ? 1 : 0;
        $product->save();

        return redirect('/admin/products')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view("admin.products.show", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product','sizes', 'colors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(Product::$editRules);
        $product = Product::findOrFail($id);
        $product->fill($request->post());
        $product['discount'] = $request['discount'] / 100;
        $product['is_recent'] = isset($request['is_recent']) ? 1 : 0;
        $product['is_featured'] = isset($request['is_featured']) ? 1 : 0;

        // If there is a new image in the request then, update. if not keep the original one.
        if ($request->file('image')) {
            $request->validate(['image' => 'required|image|max:2048']);
            $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);
            $product['image'] = $imageUrl;
        }
        
        $product->save();

        return redirect('/admin/products')->with('success', 'Product edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // delete image of the product
        Storage::disk('public')->delete($product['image']);
        
        Product::destroy($id);
        return redirect('/admin/products')->with('success', 'Product deleted successfully');
    }
}
