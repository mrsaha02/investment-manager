<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard',[StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/add-student',[StudentController::class, 'add'])->name('add-student');
    Route::get('/edit-student/{id}',[StudentController::class, 'edit'])->name('student.edit');
    Route::get('/delete-student/{id}',[StudentController::class, 'delete'])->name('student.delete');
    Route::post('/update-student/{id}',[StudentController::class, 'update'])->name('student.update');
    Route::post('/new-student',[StudentController::class, 'newStudent'])->name('new-student');

});
