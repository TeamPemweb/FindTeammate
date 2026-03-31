<?php

use Illuminate\Support\Facades\Route;

//* Debug route
Route::get('/app', function (){
    return view('layouts.app');
})->name('app');

//*Landing page
Route::get('/', function () {
    return view('welcome');
});

//* Authentication Route
Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/signup', function () {
    return view('pages.signup');
})->name('signup');

Route::get('/otp', function () {
    return view('layouts.otp');
})->name('otp');

//* Dashboard Route
Route::redirect('/dashboard', '/dashboard/dikelola');

Route::get('/dashboard/dikelola', function () {
    return view('pages.dikelola');
})->name('dashboard.dikelola');

Route::get('/dashboard/diikuti', function () {
    return view('pages.diikuti');
})->name('dashboard.diikuti');
