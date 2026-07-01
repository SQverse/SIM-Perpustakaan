<?php

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController; 
use App\Http\Controllers\BukuController;
// Jika kamu punya controller khusus laporan, jangan lupa di-import juga. Contoh:
// use App\Http\Controllers\LaporanController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Bisa diakses Admin & Anggota)
Route::get('/dashboard', function () {
    $data = [
        'total_buku' => Buku::count(),
        'total_anggota' => Anggota::count(),
        'total_pinjam' => Peminjaman::where('status', 'dipinjam')->count(),
        // Khusus Anggota: Hitung buku yang sedang dia pinjam
        'buku_dipinjam_user' => Auth::check() ? Peminjaman::where('anggota_id', Auth::id())->where('status', 'dipinjam')->count() : 0,
    ];
    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

// Profil Pengguna (Bisa diakses Admin & Anggota)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// JALUR BERSAMA: Boleh diakses semua yang sudah login (Admin & Anggota)
// =========================================================================
Route::middleware(['auth'])->group(function () {
    // Katalog Buku (Hanya lihat daftar)
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    
    // Sirkulasi / Riwayat Pinjam (Hanya bisa LIHAT daftar riwayatnya sendiri/semua)
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
});

// =========================================================================
// JALUR KHUSUS ADMIN: HANYA Admin yang boleh mengelola data
// =========================================================================
Route::middleware(['auth', 'cekrole:admin'])->group(function () {

    // --- KATEGORI ---
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // --- CRUD ANGGOTA ---
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/tambah', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // --- CRUD BUKU ---
    Route::get('/buku/tambah', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::put('/peminjaman/{id}/kembali', [PeminjamanController::class, 'kembalikanBuku'])->name('peminjaman.kembali');

    Route::put('/peminjaman/{id}/kembali', [PeminjamanController::class, 'kembalikanBuku'])->name('peminjaman.kembali');
});

require __DIR__.'/auth.php';