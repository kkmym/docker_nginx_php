<?php

use Illuminate\Support\Facades\Route;
use MyApp1\Controllers\TopController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('myapp/', [TopController::class, 'xxx']);