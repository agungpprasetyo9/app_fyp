<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\University;
use App\Models\Major;
use App\Models\Value;

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
        $tryoutNames = [];
        $tryoutValues = [];
        $studentId = Auth::id();
        
        $result = DB::table('tryouts')
            ->join('values', 'tryouts.id', '=', 'values.tryout_id')
            ->join('students', 'values.student_id', '=', 'students.id')
            ->where('students.id', '=', $studentId)
            ->select('tryouts.tryout_name',DB::raw('ROUND(AVG(values.value)) as score') )
            ->get();

        
        foreach ($result as $row) {
            $tryoutNames[] = $row->tryout_name;
            $tryoutValues[] = $row->score;
        }
    // dd($tryoutNames);
    $result = DB::table('values as v')
        ->join('tryouts', 'v.tryout_id', '=', 'tryouts.id')
        ->crossJoin(DB::raw('(SELECT COUNT(id) AS total_tryouts FROM tryouts) AS subquery'))
        ->where('v.student_id', '=', $studentId)
        ->selectRaw('SUM(v.value) / (subquery.total_tryouts) AS average_value')
        ->first();

$averageValue = $result->average_value;

    // $universities = University::pluck('university_name');
    // $universities = University::select('university_name')->paginate(10);
    $majors = Major::all();
    $universities = University::all();
    // $alluniversities = University::all()->toArray();
    $score = Value::where('student_id', auth()->user()->id)->avg('value');
    dd($score);
    
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
        Route::get('/individu',[AdminController::class, 'individu'])->name('admin.individu');
        Route::get('/individu/{id}',[AdminController::class, 'detail'])->name('admin.detail');
        Route::get('/alumni',[AdminController::class, 'alumni'])->name('admin.alumni');


    });

    // Rute-rute siswa
    Route::prefix('student')->group(function () {
        // Route::get('/studentdashboard', function () {
        //     return view('student.dashboard');
        // })->name('student.dashboard');
        Route::get('/studentdashboard',[StudentController::class, 'index'])->name('student.dashboard');
        // Route::get('/studentdashboard/search?{query}',[StudentController::class, 'search'])->name('student.search');
        Route::post('/search', [StudentController::class, 'search'])->name('search');
        
    });
});