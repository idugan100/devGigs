<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingControler extends Controller
{   
    //get all listings
    public function index(){
        return view('listings',[
            "header"=>'Latest Listing',
            "listings"=>Listing::all()
        ]);

    }
    //get single listing
    public function show(Listing $listing){
        return view('listing',[
            "header"=>'Latest Listing',
            "listing"=>$listing
        ]);
    }
}
