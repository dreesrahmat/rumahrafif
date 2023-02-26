<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PengaturanHalamanController;

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
    return view('welcome');
});

Route::redirect('home', 'dashboard');

Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->middleware('guest');
Route::get('/auth/callback', [AuthController::class, 'callback'])->middleware('guest');
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::prefix('dashboard')->middleware('auth')->group(
    function() {
        Route::get('/', [HalamanController::class, 'index']);
        Route::resource('/halaman', HalamanController::class);
        Route::resource('/experience', ExperienceController::class);
        Route::resource('/education', EducationController::class);
        Route::get('/skill', [SkillController::class, 'index'])->name('skill.index');
        Route::post('/skill/update', [SkillController::class, 'update'])->name('skill.update');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/pengaturanhalaman', [PengaturanHalamanController::class, 'index'])->name('pengaturanhalaman.index');
        Route::post('/pengaturanhalaman/update', [PengaturanHalamanController::class, 'update'])->name('pengaturanhalaman.update');
    }
);

