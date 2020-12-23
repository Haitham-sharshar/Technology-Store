<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('front.registration.index');
    }

    public function store(Request $request)
    {
        //validate the user
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed'
        ]);
        // save the data
        DB::table('users')->insert (($request->except('_token')));
        //or
       // $user = User::create($request->all());
       // sign in the user
      //  auth()->login($user);
        //redirect
        return redirect('/user/profile');
    }
}
