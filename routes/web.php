<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/signup', function () {
    return view('pages.signup');
})->name('signup');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/otp', function () {
    return view('layouts.otp');
})->name('otp');

Route::get('/app', function (){
    return view('layouts.app');
})->name('app');