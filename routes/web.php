<?php

use App\Http\Controllers\ListingControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common Resource Routes defined in controller:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  
//all listings 
Route::get('/', [ListingControler::class,'index']);

//show create form
Route::get('/listings/create',[ListingControler::class,'create']);
//store new listing
Route::post('/listings',[ListingControler::class,'store']);

//show edit from
Route::get('/listings/{listing}/edit',[ListingControler::class,'edit']);

//store edits
Route::put('/listings/{listing}',[ListingControler::class,'update']);

//delete single listing
Route::delete('/listings/{listing}',[ListingControler::class,'destroy']);

//single listing
Route::get('/listings/{listing}',[ListingControler::class,'show']);

//show register create form
Route::get('/');


