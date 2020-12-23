<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public   function index()
    {
        $product = Product::inRandomOrder()->get();
        return view('front.index',compact('product'));
    }
}
