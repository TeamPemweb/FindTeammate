<?php

use Illuminate\Support\Facades\Route;

Route::get('/app', function (){
    return view('layouts.app');
})->name('app');

Route::get('/', function () {
    return view('pages.landingPage');
});

Route::get('/login', function () {
    return view('pages.mahasiswa.login');
})->name('login');

Route::get('/signup', function () {
    return view('pages.mahasiswa.signup');
})->name('signup');

Route::get('/otp', function () {
    return view('layouts.otp');
})->name('otp');

Route::redirect('/dashboard', '/dashboard/dikelola');

Route::get('/dashboard/dikelola', function () {
    return view('pages.mahasiswa.dikelola');
})->name('dashboard.dikelola');

Route::get('/dashboard/diikuti', function () {
    return view('pages.mahasiswa.diikuti');
})->name('dashboard.diikuti');

Route::get('cariProyek', function () {
    return view('pages.mahasiswa.proyek.cariProyek');
})->name('cariProyek');

Route::redirect('/proyekSaya', '/proyekSaya/dikelola');

Route::get('/proyekSaya/dikelola', function () {
    return view('pages.mahasiswa.proyek.proyekSaya');
})->name('proyekSaya.dikelola');

Route::get('/proyekSaya/diikuti', function () {
    return view('pages.mahasiswa.proyek.proyekSaya');
})->name('proyekSaya.diikuti');

Route::get('/lamaranSaya', function () {
    return view('pages.mahasiswa.lamaranSaya');
})->name('lamaranSaya');

Route::get('profile', function () {
    return view('pages.mahasiswa.profile');
})->name('profile');

Route::get('editProfile', function () {
    return view('pages.mahasiswa.editProfile');
})->name('editProfile');

Route::get('proyekDikelola', function () {
    return view('pages.mahasiswa.proyek.proyekDikelola');
})->name('proyekDikelola');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboardAdmin');
    })->name('admin.dashboard');

    Route::get('/pengguna', function () {
        return view('pages.admin.manajemenPengguna');
    })->name('admin.pengguna');
});