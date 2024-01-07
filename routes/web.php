<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\PsLateController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PsStudentController;

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

// Route::get('/home', function() {
//     return view('home');
// })->name('home');


Route::get('/', function() {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');


Route::middleware(['IsLogin'])->group(function() {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/pshome', function() {
        return view('ps.pshome');
    })->name('pshome');
    
});

Route::middleware(['IsLogin', 'IsAdmin'])->group(function() {
    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [RombelController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/rayon')->name('rayon.')->group(function() {
        Route::get('/', [RayonController::class, 'index'])->name('index');
        Route::get('/create', [RayonController::class, 'create'])->name('create');
        Route::post('/store', [RayonController::class, 'store'])->name('store');
        Route::get('/{id}', [RayonController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RayonController::class, 'update'])->name('update');
        Route::delete('/{id}', [RayonController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/rombel')->name('rombel.')->group(function() {
        Route::get('/', [RombelController::class, 'index'])->name('index');
        Route::get('/create', [RombelController::class, 'create'])->name('create');
        Route::post('/store', [RombelController::class, 'store'])->name('store');
        Route::get('/{id}', [RombelController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RombelController::class, 'update'])->name('update');
        Route::delete('/{id}', [RombelController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/siswa')->name('siswa.')->group(function() {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/late')->name('late.')->group(function() {
        Route::get('/', [LateController::class, 'index'])->name('index');
        Route::get('/recap', [LateController::class, 'recap'])->name('recap');
        Route::get('/create', [LateController::class, 'create'])->name('create');
        Route::post('/store', [LateController::class, 'store'])->name('store');
        Route::get('/{id}', [LateController::class, 'edit'])->name('edit');
        Route::get('/late/{siswa_id}', [LateController::class, 'detail'])->name('recap.detail');
        Route::get('/download/{id}', [LateController::class, 'cetak'])->name('recap.download');
        Route::patch('/{id}', [LateController::class, 'update'])->name('update');
        Route::delete('/{id}', [LateController::class, 'destroy'])->name('delete');
        Route::get('/print/{id}', [LateController::class, 'show'])->name('print');
        Route::get('/export-excel', [LateController::class, 'exportExcel'])->name('export-require');
    });
});

Route::middleware(['IsLogin', 'IsPs'])->group(function() {
    Route::prefix('/ps')->name('ps.')->group(function() {
        Route::prefix('/siswa')->name('siswa.')->group(function() {
            Route::get('/', [PsStudentController::class, 'index'])->name('index');
        });
        Route::prefix('/late')->name('late.')->group(function() {
            Route::get('/', [PsLateController::class, 'index'])->name('index');
            Route::get('/recap', [PsLateController::class, 'recap'])->name('recap');
            Route::get('/late/{siswa_id}', [LateController::class, 'detail'])->name('recap.detail');
        });
    });
   
});
