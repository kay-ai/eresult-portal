<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\CourseController;
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
    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index')->name('viewStudents');
        Route::post('/upload-students', 'store')->name('uploadStudents');
    });
    Route::controller(AcademicSessionController::class)->group(function () {
        Route::get('/academic-session', 'index')->name('viewSessions');
        Route::get('/create-session', 'store')->name('createSession');
        Route::post('/update', 'update')->name('updateSession');
        Route::delete('/delete-session/{id}', 'destroy')->name('deleteSession');
    });
    Route::controller(LevelController::class)->group(function () {
        Route::get('/levels', 'index')->name('levels');
        Route::get('/create-level', 'store')->name('createLevel');
        Route::post('/update', 'update')->name('updateLevel');
        Route::delete('/delete-level/{id}', 'destroy')->name('deleteLevel');
    });
    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'index')->name('viewCourses');
        Route::get('/create-course', 'store')->name('createCourse');
        Route::get('/edit-course/{id}', 'edit')->name('vieweditCourse');
        Route::post('/update', 'update')->name('updateCourse');
        Route::delete('/delete-course/{id}', 'destroy')->name('deleteCourse');
    });
    Route::controller(ResultController::class)->group(function () {
        Route::get('/results', 'index')->name('results');
        Route::post('/upload-results', 'store')->name('uploadResults');
        Route::post('/drop', 'destroy')->name('dropResults');
        Route::get('/view-results', 'show')->name('viewResults');
    });
});
