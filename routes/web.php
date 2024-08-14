<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontPinjamController;
use App\Http\Controllers\FrontReviewController;
use App\Http\Controllers\FrontSettingController;
use App\Http\Controllers\DaftarBukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/laravel', function () {
    return view('welcome');
});

// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
// Route::get('kategori/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('kategori/{kategori}/edit', [KategoriController::class, 'update'])->name('kategori.update');
// Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::resource('/dashboard/users', \App\Http\Controllers\UsersController::class);

Route::group(['middleware' => 'guest'], function (){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'loginProses'])->name('loginProses');
});

// Route::get('dashboard', [DashboardController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function (){
    // Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
    // Route::resource('buku', \App\Http\Controllers\BukuController::class);
    // Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/home', HomeController::class)->middleware('userAkses:User');
    Route::resource('daftarbuku', DaftarBukuController::class)->middleware('userAkses:User');
    Route::resource('pinjambuku', FrontPinjamController::class)->middleware('userAkses:User');
    Route::resource('review',FrontReviewController::class)->middleware('userAkses:User');
    Route::resource('dashboard', DashboardController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('buku', BukuController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('kategori',KategoriController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('ulasan',UlasanController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('user',UsersController::class)->middleware('userAkses:Administrator');
    Route::resource('pinjam',PinjamController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('laporan',LaporanController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('setting',SettingController::class)->middleware('userAkses:Administrator,Officer');
    Route::resource('usersetting',FrontSettingController::class)->middleware('userAkses:User');
});