<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function index()
    {
        return view('admin.login');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        // validate the user (Admin)
        $request->validate([
           'email'=> 'required|email',
            'password'=>'required'
        ]);
        // log the user (Admin) in
        $fields = $request->only('email','password');
       if(! Auth::guard('admin')->attempt($fields)){
           return back()->withErrors([
               'message'=> 'wrong data please try again'
           ]);
       }

        // session message
        session()->flash('msg','You have been logged in');

        // Redirect
        return redirect('/admin');
    }

  public function logout()
  {
      Auth::guard('admin')->logout();
      session()->flash('msg','You have been logged out');
      return redirect('/admin/login');
  }

}
