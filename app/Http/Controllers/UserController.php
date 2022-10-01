<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Confirm;

class UserController extends Controller
{
    //show register user view
    public function create(){
        return view('users.register');
    }

    //store new user
    public function store(Request $request){
        $formFields=$request->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email',Rule::unique('users','email')],//table and attribite it cannot duplicate
            'password'=>['required','confirmed','min:6']
        ]);
        //password hashing
        $formFields['password']=bcrypt($formFields['password']);
        $user=User::create($formFields);
        auth()->login($user);
        return redirect('/')->with('message','Account Created! Welcome!');
    }

    //logout user
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','Successfully logged out!');
    }
    //show login user screen
    public function login(){
        return view('users.login');
    }
    //log in user
    public function authenticate(Request $request){
        $formFields=$request->validate([
            'email'=>['required','email'],//table and attribite it cannot duplicate
            'password'=>['required','min:6']
        ]);
        if (Auth::attempt($formFields))
        {
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now logged in!');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');

    }
}
