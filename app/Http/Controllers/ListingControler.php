<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingControler extends Controller
{   
    //get all listings
    public function index(){
        
        return view('listings.index',[
            "header"=>'Latest Listing',
            "listings"=>Listing::latest()->filter(request(['tag','search']))->get()
        ]);

    }
    //get single listing
    public function show(Listing $listing){
        return view('listings.show',[
            "header"=>'Latest Listing',
            "listing"=>$listing
        ]);
    }

    
    // show create page
    public function create(){
        return view('listings.create');
    }

    //store new listing
    public function store(Request $request){
        //validation
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],//table and attribite it cannot duplicate
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'

        ]);
        Listing::create($formFields);

        return redirect('/');

    }
}
