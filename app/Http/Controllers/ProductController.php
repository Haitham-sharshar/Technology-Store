<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
           'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'image'=>'image|required'
        ]);
        //upload the image
        if($request->hasFile('image')){
            $image = $request->image;
            $image->move('uploades',$image->getClientOriginalName());
        }
        // save data into database
        Product::create([
           'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$request->image->getClientOriginalName()
        ]);
        //store a message to session
        $request->session()->flash('msg','new product has been added');
        return redirect('products/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.products.details',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //find the product
        $product = Product::find($id);
        // validate the form
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);
        // check if there is any image
        if($request->hasFile('image'))
        {
            //upload new image
            $image = $request->image;
            $image->move('uploades',$image->getClientOriginalName());
            $product->image = $request->image->getClientOriginalName();
        }
        //updating the product
        $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$product->image
        ]);
         // store message to session
        $request->session()->flash('msg','The product has been updated');
        //redirect
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //delete the product
        Product::destroy($id);
        //store a session message
        session()->flash('msg','product has been deleted');
        //Redirect
        return redirect('admin/products');
    }
}
