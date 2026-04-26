<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;

// ROUTES: LANDING PAGE & AUTHENTICATIONS
Route::get('/', function () {
    return view('landing.landingPage');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'register']);

    Route::get('/otp', function () {
        return view('auth.otp');
    })->name('otp');
});


// ROUTES: DASHBOARD [DIKELOLA, DIIKUTI, ]
Route::middleware('auth')->group(function () {

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::redirect('/dashboard', '/dashboard/dikelola');
Route::get('/dashboard/dikelola', function () {
    return view('projects.dikelola');
})->name('dashboard.dikelola');

Route::get('/dashboard/diikuti', function () {
    return view('projects.diikuti');
})->name('dashboard.diikuti');

Route::get('cari-proyek', function () {
    return view('projects.cariProyek');
})->name('cariProyek'); 

Route::redirect('/proyek-saya', '/proyek-saya/dikelola');

Route::get('/proyek-saya/dikelola', function () {
    return view('projects.proyekSaya');
})->name('proyekSaya.dikelola');

Route::get('/proyek-saya/diikuti', function () {
    return view('projects.proyekSaya');
})->name('proyekSaya.diikuti');

Route::get('/lamaran-saya', function () {
    return view('projects.lamaranSaya');
})->name('lamaranSaya');



// ROUTE: PROFILE
Route::get('profile', function () {
    return view('profile.profile');
})->name('profile');

Route::get('edit-profile', function () {
    return view('profile.editProfile');
})->name('editProfile');

Route::get('profile-pelamar', function () {
    return view('profile.profilPelamar');
})->name('profilePelamar');



// ROUTE: DETAIL PROYEK
Route::get('proyek-dikelola', function () {
    return view('projects.proyekDikelola');
})->name('proyekDikelola');

Route::get('detail-proyek', function () {
    return view('projects.detailProyek');
})->name('detailProyek');

Route::get('/detail-proyek-dikelola', function () {
    return view('pages.detaildikelola');
})->name('detailProyekdikelola');

Route::get('/proyek-diikuti', function () {
    return view('projects.proyekDiikuti');
})->name('proyekDiikuti');

Route::get('/edit-proyek', function () {
    return view('projects.editProyek');
})->name('editProyek');

Route::get('/lamar-proyek', function () {
    return view('projects.lamarProyek');
})->name('lamarProyek');

Route::get('/buat-proyek', function () {
    return view('projects.buatProyek');
})->name('buatProyek');

// Routes: Api
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/proyek-dikelola/{id}', [ProjectController::class, 'show'])->name('proyekDikelola');


// ROUTES: ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboardAdmin');
    })->name('admin.dashboard');

    Route::get('/pengguna', function () {
        return view('admin.manajemenPengguna');
    })->name('admin.pengguna');
});
});





