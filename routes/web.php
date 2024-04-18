<?php

use App\Http\Controllers\AssesmentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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


Route::middleware(['auth', 'multirole:admin,kepala_sekolah'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users', [UserController::class, 'adminAddUser'])->name('users.add');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{id}/edit', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('guru', [TeacherController::class, 'index'])->name('teacher.index');
    Route::post('guru', [TeacherController::class, 'store'])->name('teacher.add');
    Route::get('guru/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::patch('guru/{id}/edit', [TeacherController::class, 'update'])->name('teacher.update');

    Route::get('mapel', [AssesmentController::class, 'index'])->name('assessment.index');
    Route::post('mapel', [AssesmentController::class, 'store'])->name('assessment.add');
    Route::delete('mapel/{id}', [AssesmentController::class, 'destroy'])->name('assessment.destroy');
    Route::get('mapel/{id}/edit', [AssesmentController::class, 'edit'])->name('assessment.edit');
    Route::patch('mapel/{id}/edit', [AssesmentController::class, 'update'])->name('assessment.update');

    Route::get('nilai', [ScoreController::class, 'index'])->name('score.index');
    Route::post('nilai', [ScoreController::class, 'store'])->name('score.add');
    Route::delete('nilai/{id}',[ScoreController::class,'destroy'])->name('score.destroy');
    Route::get('nilai/{id}/edit', [ScoreController::class, 'edit'])->name('score.edit');
    Route::patch('nilai/{id}/edit', [ScoreController::class, 'update'])->name('score.update');
});

Route::middleware(['auth', 'multirole:admin,guru,kepala_sekolah'])->group(function () {
    Route::get('kelas', [ClassroomController::class, 'index'])->name('classroom.index');
    Route::post('kelas', [ClassroomController::class, 'store'])->name('classroom.add');
    Route::get('kelas/{id}', [StudentClassroomController::class,'show'])->name('classroom.view');
    Route::delete('kelas/{id}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
    Route::delete('kelas/{classroom}/{id}', [StudentClassroomController::class, 'destroy'])->name('classroom.student.destroy');
    Route::get('kelas/{id}/edit', [ClassroomController::class, 'edit'])->name('classroom.edit');
    Route::patch('kelas/{id}/edit', [ClassroomController::class, 'update'])->name('classroom.update');
    Route::patch('kelas/pindah-kelas', [ClassroomController::class, 'classChange'])->name('classroom.pindah');

    Route::get('kelas/siswa',[StudentClassroomController::class,'index'])->name('student.classroom.index');
    // Route::get('kelas/siswa/{id}',[StudentClassroomController::class,'show'])->name('student.classroom.show');

    Route::get('nilai/siswa', [StudentAssessmentController::class, 'index'])->name('student.assessment.index');
    Route::post('nilai/siswa', [StudentAssessmentController::class, 'store'])->name('student.assessment.add');
    Route::get('nilai/siswa/{id}', [StudentAssessmentController::class, 'assessment'])->name('student.assessment.show');
    Route::get('nilai/siswa/{id}/view', [StudentAssessmentController::class, 'assessmentList'])->name('student.assessment.view');

    Route::get('siswa', [StudentProfileController::class, 'index'])->name('students.index');
    Route::get('siswa/add', [StudentProfileController::class, 'addStudent'])->name('students.add.index');
    Route::post('siswa/add', [StudentProfileController::class, 'store'])->name('students.add');
    Route::get('siswa/{id}', [StudentProfileController::class, 'show'])->name('students.profile');
    Route::get('siswa/{classroom}/{id}/nilai-akhir', [StudentProfileController::class, 'singleStudent'])->name('students.view');
    // Route::patch('siswa/{id}/edit', [StudentProfileController::class, 'update'])->name('students.update');
    // Route::delete('siswa/{id}/delete', [StudentProfileController::class, 'destroy'])->name('students.destroy');
});
