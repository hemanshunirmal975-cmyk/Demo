<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EmployeeController;
Route::get('/', function () {
    return view('home');
});
Route::get('/hello', function () {
    return view('hello');
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

// Add ->name('employees.index') to the end of the index route
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// Add ->name('employees.create') to the end of the create route
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');

// Add ->name('employees.store') to the end of the store route
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// Add ->name('employees.destroy') to the end of the delete route
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');