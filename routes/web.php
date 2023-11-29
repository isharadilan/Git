<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;

/*

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

Route::get('/' , [HomeController::class,"index"])->name('dashboard');

//Student routes
Route::prefix('/students')->group(function (){
    Route::get('/' , [StudentsController::class,"index"])->name('students');
    Route::post('/store' , [StudentsController::class,"store"])->name('students.store');
    Route::get('{student_id}/get' , [StudentsController::class,"get"])->name('students.get');
    Route::get('/edit' , [StudentsController::class,"edit"])->name('students.edit');
    Route::post('/{student_id}/update' , [StudentsController::class,"update"])->name('students.update');
    Route::get('/{student_id}/delete' , [StudentsController::class,"delete"])->name('students.delete');
    Route::get('/{student_id}/active' , [StudentsController::class,"active"])->name('students.active');
});


require __DIR__.'/auth.php';
