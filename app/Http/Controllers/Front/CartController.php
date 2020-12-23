<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.index');
    }
    public function store(Request $request)
    {
        // search if item exists in Cart
        $dubl = Cart::search(function($cartItem,$rowId) use($request){
           return $cartItem->id === $request->id ;
        });

        if($dubl->isNotEmpty()){
            return redirect()->back()->with('msg' , 'Item is aleardy in your cart');
        }

       Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');
        return redirect()->back()->with('msg','item has been added');
    }
    public function destroy($id)
    {
      Cart::remove($id);
        return redirect()->back()->with('msg','item has been removed from your cart');
    }
    public function saveLater($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);
        // search if item exists in save for later
        $dubl = Cart::instance('saveForLater')->search(function($cartItem,$rowId) use($id){
            return $rowId === $id ;
        });

        if($dubl->isNotEmpty()){
            return redirect()->back()->with('msg' , 'Item was saved for later before ');
        }


        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Product');
        return redirect()->back()->with('msg','item has been saved for later');
    }
    public function update(Request $request , $id)
    {
        //Validate the request
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,4'
        ]);
        if ($validator->fails())
        {
            session()->flash('errors','quantity must be between 1 and 4');
            return response()->json(['success'=>false]);

        }
        Cart::update($id , $request->quantity);
        session()->flash('msg','quantity has been updated');
        return response()->json(['success'=>true]);
    }
}
