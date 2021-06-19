<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\AccountSetting;

class AccountSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountSettings = AccountSetting::all();
        //dd($accountSettings);
        return view('account-settings.index')->with('accountSettings', $accountSettings);
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
        /* $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            
            'image' => 'required|image|max:1999',
        ]); */

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


        
        //Create Account Settings
        $AccountSetting = new AccountSetting;
        $AccountSetting->first_name = $request->input('first_name');
        $AccountSetting->last_name = $request->input('last_name');
        $AccountSetting->email = $request->input('email');
        
        if($request->hasFile('image')){
        $AccountSetting->image = $fileNameToStore;
        }
        $AccountSetting->save();

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
        $accountSetting = AccountSetting::find($id);
        return view('account-settings.edit')->with('accountSetting',$accountSetting);
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
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


        
        //Create Account Settings
        $accountSetting = AccountSetting::find($id);
        //dd($accountSetting);
        $accountSetting->first_name = $request->input('first_name');
        $accountSetting->last_name = $request->input('last_name');
        $accountSetting->email = $request->input('email');
        
        if($request->hasFile('image')){
        $accountSetting->image = $fileNameToStore;
        }
        $accountSetting->save();

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
        //
    }
}
