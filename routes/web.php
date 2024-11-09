<?php

use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginRegisterController;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BukuController::class, 'index']);

Route::get('/bukupublic', [BukuController::class, 'indexpublic'])->name('buku.index.public');
Route::get('/admin/buku', [BukuController::class, 'indexadmin'])->name('buku.index.admin');

Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create')->middleware('admin');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store')->middleware('admin');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy')->middleware('admin');
Route::get('/buku/{id}', [BukuController::class, 'update'])->name('buku.update')->middleware('admin');
Route::put('/buku/{id}', [BukuController::class, 'edit'])->name('buku.edit')->middleware('admin');
Route::post('/buku/{id}', [BukuController::class, 'edit'])->name('buku.edit')->middleware('admin');
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search')->middleware('admin');

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/send-mail', [SendEmailController::class, 'index'])->name(name: 'kirim-email');
Route::post('/post-email', [SendEmailController::class, 'store'])->name(name: 'post-email');

Storage::disk('local')->put('file.txt', 'Contents');
