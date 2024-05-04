<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\PlatformController;
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

Route::get('/', function () {
    return view('app');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::post('/courses',[CourseController::class, 'store'])->name('courses');
Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])->name('courses-edit');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses-show');
Route::patch('/courses/{id}', [CourseController::class, 'update'])->name('courses-update');
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses-delete');


Route::resource('platforms',PlatformController::class);