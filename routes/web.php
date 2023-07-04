<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

use App\Models\User;
Route::get('/test', function () {
    // $users = User::where('is_admin', false)->pluck('id')->toArray();
    // dd($users);
});

    // Route untuk halaman login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Route untuk halaman register
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

     //Route Log Out

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Tambahkan rute lain yang perlu dilindungi sebagai dashboard admin di sini

    // Route::get('/admindashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');
// });


// Route::middleware(['auth', 'student'])->prefix('student')->group(function () {

    // Tambahkan rute lain yang perlu dilindungi sebagai dashboard student di sini

    // Route::get('/studentdashboard', function () {
    //     return view('student.dashboard');
    // })->name('student.dashboard');
// });

Route::middleware('auth')->group(function () {
    // Rute-rute yang memerlukan autentikasi

    // Rute-rute admin
    // Route::prefix('admin')->group(function () {
    //     Route::get('/admindashboard', function () {
    //         return view('admin.dashboard');
    //     })->name('admin.dashboard');
    // });
    Route::prefix('admin')->group(function () {
        Route::get('/admindashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Rute-rute siswa
    Route::prefix('student')->group(function () {
        Route::get('/studentdashboard', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });
});