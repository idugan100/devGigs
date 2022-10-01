<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingControler extends Controller
{   

    //show edit form
    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);
    }
    //updtae listing
    public function update(Request $request, Listing $listing){
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>'required',//table and attribite it cannot duplicate
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
            
        ]);
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
            
        }
        
        
        $listing->update($formFields);

        return back()->with('message','Listing edited successfully!');

    }
    //get all listings
    public function index(){
        
        return view('listings.index',[
            "header"=>'Latest Listings',
            "listings"=>Listing::latest()->filter(request(['tag','search']))->paginate(8)
        ]);

    }
    //get single listing
    public function show(Listing $listing){
        return view('listings.show',[
            "header"=>'Latest Listing',
            "listing"=>$listing
        ]);
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message','Listing successfully deleted!');
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
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
            
        }
        
        
        Listing::create($formFields);

        return redirect('/')->with('message','Listing created successfully!');

    }
}
