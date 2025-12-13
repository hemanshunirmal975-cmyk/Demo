<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return view('hello');
});


//test database connection
Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return "DB Connected Successfully!";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
