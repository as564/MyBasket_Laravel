<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
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
            'type' => 'required|string|max:255',
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


        
        //Create Category
        $category = new Category;
        //$category->image = $request->input('image');
        $category->name = $request->input('name');
        $category->type = $request->input('type');
        if($request->hasFile('image')){
        $category->image = $fileNameToStore;
        }
        $category->save();

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
        $category = Category::find($id);
        return view('categories.edit')->with('category',$category);
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
        //echo "Hello";
        //exit;
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
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


        //$user = User::find($id);
        //Create Category
        $category = Category::find($id);
        //$category->image = $request->input('image');
        $category->name = $request->input('name');
        $category->type = $request->input('type');
        if($request->hasFile('image')){
        $category->image = $fileNameToStore;
        }
        $category->save();

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
        $category = Category::find($id);

        if($category->image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/images/'.$category->image);
        }
        $category->delete();
        //return redirect('/categories')->with('success', 'Category Deleted');
    }
}
