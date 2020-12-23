<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

class saveLaterController extends Controller
{
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);
        return redirect()->back()->with('msg','item has been removed from Save for Later');
    }
    public function moveToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);
        Cart::remove($id);
        // search if item exists in save for later
        $dubl = Cart::instance('saveForLater')->search(function($cartItem,$rowId) use($id){
            return $cartItem === $id ;
        });

        if($dubl->isNotEmpty()){
            return redirect()->back()->with('msg' , 'Item was saved for later before ');
        }


        Cart::instance('default')->add($item->id,$item->name,1,$item->price)->associate('App\Product');
        return redirect()->back()->with('msg','item has been moved to cart');
    }
}
