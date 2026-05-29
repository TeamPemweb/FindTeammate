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

    Route::get('/otp', fn() => view('auth.otp'))->name('otp');
    Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
});


// ROUTES: DASHBOARD [DIKELOLA, DIIKUTI, ]
Route::middleware('auth','verified')->group(function () {

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::redirect('/dashboard', '/dashboard/dikelola');
Route::get('/dashboard/dikelola', [ProjectController::class, 'dashboardDikelola'])->name('dashboard.dikelola');

Route::get('/dashboard/diikuti', [ProjectController::class, 'dashboardDiikuti'])->name('dashboard.diikuti');

Route::get('cari-proyek', [ProjectController::class, 'cariProyek'])->name('cariProyek');
Route::get('api/proyek/search', [ProjectController::class, 'searchProjectsApi'])->name('api.cariProyek');

Route::redirect('/proyek-saya', '/proyek-saya/dikelola');

Route::get('/proyek-saya/dikelola', [ProjectController::class, 'indexDikelola'])->name('proyekSaya.dikelola');

Route::get('/proyek-saya/diikuti', function () {
    return view('projects.proyekSaya');
})->name('proyekSaya.diikuti');

Route::get('/lamaran-saya', [ProjectController::class, 'lamaranSaya'])->name('lamaranSaya');



// ROUTE: PROFILE
Route::get('profile', function () {
    return view('profile.profile');
})->name('profile');

Route::get('edit-profile', function () {
    return view('profile.editProfile');
})->name('editProfile');
Route::put('edit-profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('updateProfile');

Route::get('profile-pelamar/{id}', [ProjectController::class, 'profilPelamar'])->name('profilePelamar');



// ROUTE: DETAIL PROYEK

Route::get('detail-proyek/{id}', [ProjectController::class, 'detailProyek'])->name('detailProyek');

Route::get('/detail-proyek-dikelola', function () {
    return view('pages.detaildikelola');
})->name('detailProyekdikelola');

Route::get('/proyek-diikuti/{id}', [ProjectController::class, 'proyekDiikuti'])->name('proyekDiikuti');

Route::get('/edit-proyek', function () {
    return view('projects.editProyek');
})->name('editProyek');

Route::get('/lamar-proyek/{id}', [ProjectController::class, 'createLamaran'])->name('lamarProyek');
Route::post('/lamar-proyek/{id}', [ProjectController::class, 'storeLamaran'])->name('storeLamaran');
Route::patch('/lamaran/{id}/accept', [ProjectController::class, 'acceptLamaran'])->name('lamaran.accept');
Route::delete('/lamaran/{id}/reject', [ProjectController::class, 'rejectLamaran'])->name('lamaran.reject');

Route::get('/buat-proyek', function () {
    return view('projects.buatProyek');
})->name('buatProyek');

// Routes: Api
//Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
//Route::get('/proyek-dikelola/{id}', [ProjectController::class, 'show'])->name('proyekDikelola');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/proyek-dikelola/{id}', [ProjectController::class, 'show'])->name('proyekDikelola');

Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');    

Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// ROUTES: ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/pengguna', [\App\Http\Controllers\AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::post('/pengguna/{id}/toggle-status', [\App\Http\Controllers\AdminController::class, 'toggleUserStatus'])->name('admin.pengguna.toggle');
    Route::get('/api/pengguna/search', [\App\Http\Controllers\AdminController::class, 'searchUsersApi'])->name('api.admin.pengguna');

    Route::get('/profile', function () {
        return view('admin.adminProfile');
    })->name('admin.profile');
});
});





