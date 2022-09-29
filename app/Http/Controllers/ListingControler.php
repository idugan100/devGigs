<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

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
}
