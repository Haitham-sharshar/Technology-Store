<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
       $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('front.login.index');
    }
    public function store(Request $request)
    {
       // dd($request->all());
        // Validate the user
        $rules = [
          'email' => 'required|email',
            'password'=>'required'
        ];
          $request->validate($rules);
        //Check if user exists
        $data = request(['email','password']);
        if (!auth()->attempt($data))
        {
            return back()->withErrors([
                'message' =>'Wrong Data .... please Try Again'
            ]);
        }
        // Redirect
        return redirect('/user/profile');
    }

    public function logout()
    {
        // logout the user
        auth()->logout();
        //Session a message
        session()->flash('msg','you have been logged out');
        //redirect the user
        return redirect('/user/login');
    }
}
