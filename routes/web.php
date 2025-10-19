<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/student-records', function () {
        $students = []; 
        return view('student-records.index', compact('students'));
    });
    
    Route::get('/student-records/create', function () {
        return view('student-records.create');
    });
    
    Route::get('/courses', function () {
        return view('courses.index');
    });
});

Route::get('/', function () {
    return redirect('/login');
});