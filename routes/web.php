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


Route::get('/dashboard/dikelola', function () {
    return view('pages.dikelola');
})->name('dashboard.dikelola');

Route::get('/dashboard/diikuti', function () {
    return view('pages.diikuti');
})->name('dashboard.diikuti');

Route::get('cariProyek', function () {
    return view('pages.cariProyek');
})->name('cariProyek');

Route::redirect('/proyekSaya', '/proyekSaya/dikelola');

Route::get('/proyekSaya/dikelola', function () {
    return view('pages.proyekSaya');
})->name('proyekSaya.dikelola');

Route::get('/proyekSaya/diikuti', function () {
    return view('pages.proyekSaya');
})->name('proyekSaya.diikuti');

Route::get('/lamaranSaya', function () {
    return view('pages.lamaranSaya');
})->name('lamaranSaya');

Route::get('profile', function () {
    return view('pages.profile');
})->name('profile');
Route::get('editProfile', function () {
    return view('pages.editProfile');
})->name('editProfile');
Route::get('profilePelamar', function () {
    return view('pages.profilPelamar');
})->name('profilePelamar');

Route::get('proyekDikelola', function () {
    return view('pages.proyekDikelola');
})->name('proyekDikelola');
Route::get('detailProyek', function () {
    return view('pages.detailProyek');
})->name('detailProyek');
Route::get('detailProyekdikelola', function () {
    return view('pages.detaildikelola');
})->name('detailProyekdikelola');
Route::get('proyekDiikuti', function () {
    return view('pages.proyekDiikuti');
})->name('proyekDiikuti');
Route::get('lamarProyek', function () {
    return view('pages.lamarProyek');
})->name('lamarProyek');