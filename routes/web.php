<?php

use App\Http\Controllers\AssesmentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\StudentClassroomController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\StudentClassroom;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [LoginController::class, 'login_form'])->middleware('guest')->name('login-page');
Route::post('login', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::get('register', [LoginController::class, 'register_form'])->middleware('guest')->name('register-page');
Route::post('register', [LoginController::class, 'register'])->middleware('guest')->name('register');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('home');
    Route::get('/home', [HomeController::class, 'dashboard'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['auth', 'multirole:admin,ketua'])->group(function () {
    Route::get('jabatan', [RoleController::class, 'index'])->name('role.index');
    Route::post('jabatan', [RoleController::class, 'store'])->name('role.add');
    Route::get('jabatan/{id}',[RoleController::class,'edit'])->name('role.edit');
    Route::patch('jabatan/{id}',[RoleController::class,'update'])->name('role.update');
    Route::delete('jabatan/{id}',[RoleController::class,'destroy'])->name('role.destroy');

    Route::get('users',[UserController::class,'index'])->name('user.index');
    Route::get('users/add',[UserController::class,'addUser'])->name('add.user.view');
    Route::post('users/add',[UserController::class,'adminAddUser'])->name('add.user');
});
