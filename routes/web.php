<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OwneController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.landing');
})->name('landing');
Route::get('/login', function () {
    return view('login');
});
Route::get('/registrasi', function () {
    return view('registrasi');
});
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi.post');

Route::get('/transaksi', [TransaksiController::class, 'daftarTransaksi'])->name('transaksi');
Route::get('/pesan', [TransaksiController::class, 'halamanPesan'])->name('pesan.page');
Route::get('/pembayaran/{id}', [TransaksiController::class, 'pembayaran'])->name('pembayaran');
Route::get('/tiket/{id}', [TransaksiController::class, 'tiket'])->name('tiket');
Route::post('/pesan', [TransaksiController::class, 'pesanPost'])->name('pesan.post');
Route::get('/paid', [TransaksiController::class, 'paid'])->name('paid');

Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
Route::post('/update-profil', [ProfilController::class, 'update'])->name('profil.update');
Route::post('/ganti-password', [AuthController::class, 'gantiPassword'])->name('profil.ganti-password');

Route::get('/tiket/{id}/cetak', [LaporanController::class, 'cetakTiket'])->name('tiket.cetak');

Route::prefix('ajax')->group(function () {
    Route::get('/jadwal-by-rute', [AjaxController::class, 'jadwalByRute'])->name('ajax.getTanggal');
    Route::get('/jadwal-by-tanggal', [AjaxController::class, 'jadwalByTanggal'])->name('ajax.getJam');
    Route::get('/bus-by-jadwal', [AjaxController::class, 'busByJadwal'])->name('ajax.getBus');
    Route::get('/get-harga', [AjaxController::class, 'getHarga'])->name('ajax.getHarga');
    Route::get('/cek-kursi', [AjaxController::class, 'cekKursi'])->name('ajax.cekKursi');
});


Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/profil', [ProfilController::class, 'owner'])->name('profile.admin');
    Route::get('/owner', [OwneController::class, 'index'])->name('owner.index');
    Route::get('/owner/tambah', function () {
        return view('backend.owner_form');
    })->name('owner.tambah');
    Route::post('/owner/store', [OwneController::class, 'insert'])->name('owner.store');

    Route::get('/bus', [BusController::class, 'index'])->name('bus.index');
    Route::get('/bus/tambah', [BusController::class, 'tambah'])->name('bus.tambah');
    Route::post('/bus/store', [BusController::class, 'store'])->name('bus.store');
    Route::post('/bus/update', [BusController::class, 'update'])->name('bus.update');
    Route::post('/bus/delete', [BusController::class, 'delete'])->name('bus.delete');

    Route::get('/rute', [BusController::class, 'rute'])->name('rute.index');
    Route::post('/rute/store', [BusController::class, 'storeRute'])->name('rute.store');
    Route::post('/rute/update', [BusController::class, 'updateRute'])->name('rute.update');
    Route::post('/rute/delete', [BusController::class, 'deleteRute'])->name('rute.delete');

    Route::get('/transaksi', [TransaksiController::class, 'daftarTransaksi'])->name('admin.transaksi');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'detailTransaksi'])->name('admin.transaksi.detail');

    Route::get('/checkin/{id?}', [TiketController::class, 'checkinPage'])->name('checkin');
    Route::post('/checkin', [TiketController::class, 'checkin'])->name('checkin.post');

    Route::get('/laporan', [LaporanController::class, 'laporanPage'])->name('admin.laporan');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.laporan.cetak');
});
Route::prefix('owner')->group(function () {
    Route::get('/', [DashboardController::class, 'owner'])->name('dashboard.owner');
    Route::get('/profil', [ProfilController::class, 'owner'])->name('profile.owner');
    Route::post('/update-profil', [ProfilController::class, 'updateOwner'])->name('profil.owner.update');


    Route::get('/jadwal', [BusController::class, 'jadwalAll'])->name('owner.jadwal');
    Route::get('/bus/{id}/jadwal', [BusController::class, 'jadwal'])->name('jadwal.index');
    Route::post('/jadwal/store', [BusController::class, 'storeJadwal'])->name('jadwal.store');
    Route::post('/jadwal/update', [BusController::class, 'updateJadwal'])->name('jadwal.update');
    Route::post('/jadwal/delete', [BusController::class, 'deleteJadwal'])->name('jadwal.delete');

    Route::get('/transaksi', [TransaksiController::class, 'daftarTransaksi'])->name('owner.transaksi');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'detailTransaksi'])->name('owner.transaksi.detail');

    Route::get('/laporan', [LaporanController::class, 'laporanPage'])->name('owner.laporan');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('owner.laporan.cetak');

    // Route::get('/rute', [BusController::class, 'rute'])->name('rute.index');
    // Route::post('/rute/store', [BusController::class, 'storeRute'])->name('rute.store');
    // Route::post('/rute/update', [BusController::class, 'updateRute'])->name('rute.update');
    // Route::post('/rute/delete', [BusController::class, 'deleteRute'])->name('rute.delete');
});
