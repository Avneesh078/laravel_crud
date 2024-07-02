<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormDataController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('/index');
});


// using resource route for product
Route::resource('products', ProductController::class);


