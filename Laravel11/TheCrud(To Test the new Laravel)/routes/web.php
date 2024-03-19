<?php

use App\Http\Controllers\ProductC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', ProductC::class);
