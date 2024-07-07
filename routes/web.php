<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/random-quote', [App\Http\Controllers\QuoteController::class,'randomQuote']);
