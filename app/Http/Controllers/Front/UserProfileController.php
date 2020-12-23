<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->id);
        $id = auth()->user()->id;
        $user = User::where('id',$id)->first();
        return view('front.profile.index',compact('user'));
    }

    public  function update(Request $request , $id)
    {
       $user = User::find($id);
        //validate
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        //update the user
        $user->update([
           'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
       //session a message
        $request->session()->flash('msg','The product has been updated');
        //redirect
        return redirect('user/profile');
    }
}
