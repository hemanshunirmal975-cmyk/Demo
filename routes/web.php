<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('home');
});


Route::get('/home',[pagecontroller::class,'home']);
Route::get('/about',[pagecontroller::class,'getabout']);
Route::get('/contact',[pagecontroller::class,'getcontact']);
Route::get('/blog',[pagecontroller::class,'getblog']);
Route::get('/service',[pagecontroller::class,'getservice']);
Route::get('/gallery',[pagecontroller::class,'getgallery']);
Route::get('/faq',[pagecontroller::class,'getfaq']);
Route::get('/carrer',[pagecontroller::class,'getcarrer']);
Route::get('/team',[pagecontroller::class,'getteam']);
Route::get('/help',[pagecontroller::class,'gethelp']);