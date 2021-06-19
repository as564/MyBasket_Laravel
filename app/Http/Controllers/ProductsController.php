<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        //dd($products);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            
            'image' => 'required|image|max:1999',
        ]);

        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
		
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        } 


        
        //Create Product details
        $product = new Product;
        $product->name = $request->input('name');
        $product->brand = $request->input('brand');
        $product->category = $request->input('category');
        $product->color = $request->input('color');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        if($request->hasFile('image')){
        $product->image = $fileNameToStore;
        }
        $product->save();

        //return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit')->with('product',$product);
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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            
            'image' => 'required|image|max:1999',
        ]);

        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
		
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        } 


        
        //Update Product details
        $product = Product::find($id);
        
        $product->name = $request->input('name');
        $product->brand = $request->input('brand');
        $product->category = $request->input('category');
        $product->color = $request->input('color');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        if($request->hasFile('image')){
        $product->image = $fileNameToStore;
        }
        $product->save();

        //return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product->image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/images/'.$product->image);
        }
        $product->delete();
        //return redirect('/categories')->with('success', 'Category Deleted');
    }
    
}
