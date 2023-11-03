<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterSiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// app/routes.php
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// app/routes.php
Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/masterproject', [ProjectController::class, 'masterproject'])->name('masterproject');
    Route::get('/mastersiswa', [MasterSiswaController::class, 'index'])->name('mastersiswa');
    Route::resource('admin/resource', ProjectController::class);
});

// login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/editkontak', [AdminController::class, 'editkontak'])->name('editkontak');
    Route::get('/editproject', [AdminController::class, 'editproject'])->name('editproject');
    Route::get('/editsiswa', [AdminController::class, 'editsiswa'])->name('editsiswa');
    Route::get('/masterkontak', [AdminController::class, 'masterkontak'])->name('masterkontak');

    // siswa
    Route::get('/tambahsiswa', [MasterSiswaController::class, 'tambah'])->name('tambahsiswa');
    Route::post('/storesiswa', [MasterSiswaController::class, 'store'])->name('storesiswa');
    Route::delete('/deletesiswa/{id}', [MasterSiswaController::class, 'delete'])->name('deletesiswa');


    // Rute untuk mengakses halaman edit siswa
    Route::get('/editsiswa/{id}', [MasterSiswaController::class, 'edit'])->name('editsiswa');

    // Rute untuk menangani pembaruan data siswa
    Route::put('/updatesiswa/{id}', [MasterSiswaController::class, 'update'])->name('updatesiswa');

    Route::get('/admin/resource/store', [ProjectController::class, 'store'])->name('tambah-project');
    Route::get('/admin/resource/{id}/create', [ProjectController::class, 'add'])->name('tambahproject');
    Route::get('/editproject/{id}', [ProjectController::class, 'edit'])->name('editproject');
    Route::post('/editproject/{id}', [ProjectController::class, 'update'])->name('updateproject');
    Route::delete('/admin/delete/{id}', [ProjectController::class, 'delete'])->name('deleteproject');
});
