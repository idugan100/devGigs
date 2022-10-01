<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingControler;

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
Route::get('/listings/create',[ListingControler::class,'create'])->middleware('auth');
//store new listing
Route::post('/listings',[ListingControler::class,'store'])->middleware('auth');

//show edit formm
Route::get('/listings/{listing}/edit',[ListingControler::class,'edit'])->middleware('auth');

//store edits
Route::put('/listings/{listing}',[ListingControler::class,'update'])->middleware('auth');

//delete single listing
Route::delete('/listings/{listing}',[ListingControler::class,'destroy'])->middleware('auth');

//single listing
Route::get('/listings/{listing}',[ListingControler::class,'show']);

//show login page
Route::get('/login',[UserController::class,'login'])->name('login');

//create new user
Route::post('/users',[UserController::class,'store']);
//log user out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
//show registration  form
Route::get('/register',[UserController::class,'create']);
//login in users
Route::post('/users/authenticate',[UserController::class,'authenticate']);


