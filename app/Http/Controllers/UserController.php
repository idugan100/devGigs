<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function logout(){
        auth()->logout();
        return redirect('/')->with('message','Successfully logged out!');
    }
}
