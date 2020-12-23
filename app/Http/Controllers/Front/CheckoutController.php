<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class CheckoutController extends Controller
{
    public function index()
    {
        return view ('front.checkout.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try{
            Stripe::charges()->create([
            'amount' => Cart::total(),
             'curency' =>'USD',
              'source' =>$request->stripeToken,
               'description' => 'any text',

            ]);
            return redirect()->back()->with('msg','Success Thanks');
        }catch (Exception $ex)
        {

        }
    }
}
