<?php

use App\Http\Controllers\DokumenHukumController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilHalamanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomepageController::class, 'index'])->name('guest.index');
Route::get('/cari-peraturan', [HomepageController::class, 'searchPeraturan'])->name('guest.peraturan.search');

Route::get('/peraturan/{id}', [HomepageController::class, 'showPeraturan'])->name('guest.peraturan.show');

Route::get('/visi-misi', [HomepageController::class, 'visiMisi'])->name('guest.visi-misi');
Route::get('/struktur-organisasi', [HomepageController::class, 'strukturOrganisasi'])->name('guest.struktur');
Route::get('/dasar-hukum', [HomepageController::class, 'dasarHukum'])->name('guest.hukum');
Route::get('/kontak', [HomepageController::class, 'kontak'])->name('guest.kontak');

Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'superadmin'  => redirect()->route('admin.dashboard'),
        'kabag_hukum' => redirect()->route('kabag.dashboard'),
        'operator'    => redirect()->route('operator.dashboard'),
        default       => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Khusus Superadmin
Route::middleware(['auth', 'peran:superadmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('user-admin.dashboard');
    })->name('admin.dashboard');

    // Nama Route: admin.profil.index
    Route::get('/profil-halaman', [ProfilHalamanController::class, 'index'])
        ->name('admin.profil.index');

    // Nama Route: admin.profil.update
    Route::post('/profil-halaman/update', [ProfilHalamanController::class, 'update'])
        ->name('admin.profil.update');
});

// Route Khusus Kabag Hukum
Route::middleware(['auth', 'peran:kabag_hukum'])->prefix('kabag')->group(function () {
    Route::get('/dashboard', function () {
        return view('user-kabag.dashboard');
    })->name('kabag.dashboard');
});

// Route Khusus Operator
Route::middleware(['auth', 'peran:operator'])->prefix('operator')->group(function () {
    Route::get('/dashboard', function () {
        return view('user-operator.dashboard');
    })->name('operator.dashboard');

    Route::resource('produk-hukum', DokumenHukumController::class);

});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
