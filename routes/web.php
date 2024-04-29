<?php

use App\Http\Controllers\AssesmentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrimarySavingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SecondarySavingController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\StudentClassroomController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\PrimarySaving;
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

    Route::get('simpanan-pokok',[PrimarySavingController::class,'index'])->name('primary.member.index');

    Route::get('simpanan-sukarela',[SecondarySavingController::class,'index'])->name('secondary.member.index');

});


Route::middleware(['auth', 'multirole:admin,ketua'])->group(function () {
    Route::get('jabatan', [RoleController::class, 'index'])->name('role.index');
    Route::post('jabatan', [RoleController::class, 'store'])->name('role.add');
    Route::get('jabatan/{id}',[RoleController::class,'edit'])->name('role.edit');
    Route::patch('jabatan/{id}',[RoleController::class,'update'])->name('role.update');
    Route::delete('jabatan/{id}',[RoleController::class,'destroy'])->name('role.destroy');

    Route::get('users',[UserController::class,'index'])->name('user.index');
});

Route::middleware(['auth', 'multirole:admin,ketua,pengurus'])->group(function () {
    Route::get('users/add',[UserController::class,'addUser'])->name('add.user.view');
    Route::post('users/add',[UserController::class,'adminAddUser'])->name('add.user');

    Route::get('anggota', [ProfileController::class, 'index'])->name('member.index');

    Route::get('pengurus/simpanan-pokok',[PrimarySavingController::class,'pIndexSaving'])->name('primary.index');
    Route::post('pengurus/simpanan-pokok/saving',[PrimarySavingController::class,'saving'])->name('primary.saving');
    Route::post('pengurus/simpanan-pokok/withdraw',[PrimarySavingController::class,'withdraw'])->name('primary.withdraw');
    Route::get('pengurus/simpanan-pokok/{id}', [PrimarySavingController::class, 'show'])->name('primary.show');

    Route::get('pengurus/simpanan-sukarela',[SecondarySavingController::class,'pIndexSaving'])->name('secondary.index');
    Route::post('pengurus/simpanan-sukarela/saving',[SecondarySavingController::class,'saving'])->name('secondary.saving');
    Route::post('pengurus/simpanan-sukarela/withdraw',[SecondarySavingController::class,'withdraw'])->name('secondary.withdraw');
    Route::get('pengurus/simpanan-sukarela/{id}',[SecondarySavingController::class,'show'])->name('secondary.show');

    Route::get('pengurus/pinjaman',[LoanController::class,'pLoanIndex'])->name('loan.index');
    Route::post('pengurus/pinjaman/loan',[LoanController::class,'loan'])->name('loan.add');
    Route::post('pengurus/pinjaman/installment',[LoanController::class,'installment'])->name('loan.installment');
});
