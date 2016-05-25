<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', $this->data);
    }

    public function profile()
    {
        $this->data['user'] = Auth::user();

        return view('profile', $this->data);
    }


    public function updateProfile()
    {
        $user = Auth::user();
        
        $rules = array(
            'name' => 'required|max:255|unique:users,name,'.$user->id,
            'phone' => 'required|min:10|max:11|unique:users,phone,'.$user->id,
            'password' => 'min:3|confirmed',
            'password_confirmation' => 'min:3'
        );

        $validator = Validator::make(Request::all(), $rules);

        //check error validate
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        //update user profile
        User::updateProfile(Request::all());

        // Succes, Redirect To User
        return redirect()->back()->with('success', 'The management users is modified.');
    }

}
