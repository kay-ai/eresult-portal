<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamOfficerController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LevelController;

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
    return view('auth.login');
});
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot.password');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/admin', 'admin')->name('adminDashboard');
    });
    Route::controller(AccountController::class)->group(function () {
        Route::get('/account', 'index')->name('account.index');
    });
    Route::controller(FacultyController::class)->group(function () {
        Route::get('/faculties', 'index')->name('faculty.index');
    });
    Route::controller(AcademicSessionController::class)->group(function () {
        Route::get('/academic-session', 'index')->name('sessions.index');
        Route::get('/create-session', 'store')->name('sessions.create');
        Route::post('/update', 'update')->name('sessions.update');
        Route::delete('/delete-session/{id}', 'destroy')->name('sessions.delete');
    });
    Route::controller(LevelController::class)->group(function () {
        Route::get('/levels', 'index')->name('levels.index');
        Route::get('/create-level', 'store')->name('levels.create');
        Route::post('/update', 'update')->name('levels.update');
        Route::delete('/delete-level/{id}', 'destroy')->name('level.delete');
    });
    Route::controller(FacultyController::class)->group(function () {
        Route::get('/faculty', 'index')->name('faculty.index');
    });
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index')->name('departments.index');
    });
    Route::controller(ExamOfficerController::class)->group(function () {
        Route::get('/exam-officer', 'index')->name('exam-officers.index');
    });
    Route::controller(GradeController::class)->group(function () {
        Route::get('/grades', 'index')->name('grades.index');
        Route::get('/create-grade', 'store')->name('createGrade');
        Route::post('/update', 'update')->name('updateGrade');
        Route::delete('/delete-grade/{id}', 'destroy')->name('deleteGrade');
    });
    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'index')->name('courses.index');
        Route::get('/create-course', 'store')->name('createCourse');
        Route::get('/edit-course/{id}', 'edit')->name('vieweditCourse');
        Route::post('/update', 'update')->name('updateCourse');
        Route::delete('/delete-course/{id}', 'destroy')->name('deleteCourse');
    });
    Route::controller(ResultController::class)->group(function () {
        Route::get('/results', 'index')->name('results.index');
        Route::get('/upload-results', 'uploadResults')->name('results.upload');
        Route::post('/upload-results', 'store');
        Route::post('/drop', 'destroy')->name('results.drop');
        Route::post('/view-results', 'show')->name('results.view');
        Route::get('/results-stats', 'resultStats')->name('results.stats');
        Route::get('/results-courses-stats', 'courseStats')->name('results.courses.stats');
    });
    Route::controller(StudentController::class)->group(function () {
        Route::get('/enroll-students', 'index')->name('students.index');
        Route::get('/all-students', 'view')->name('students.view');
        Route::post('/upload-students', 'store')->name('students.enroll');
    });
});
