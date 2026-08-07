<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - CBT PMB System (Laravel Backend & Integration)
|--------------------------------------------------------------------------
*/

// Student / Participant Routes (No Account / No Login Required)
Route::get('/', [StudentController::class, 'landing']);
Route::get('/student/landing', [StudentController::class, 'landing']);
Route::get('/student/form', [StudentController::class, 'showForm']);
Route::post('/student/form', [StudentController::class, 'storeForm']);
Route::get('/student/info', [StudentController::class, 'showInfo']);
Route::post('/student/start', [StudentController::class, 'startExam']);
Route::get('/student/exam', [StudentController::class, 'showExam']);
Route::post('/student/autosave-answer', [StudentController::class, 'autosaveAnswer']);
Route::post('/student/log-violation', [StudentController::class, 'logViolation']);
Route::post('/student/submit', [StudentController::class, 'submitExam']);
Route::get('/student/thank-you', [StudentController::class, 'thankYou']);

// Admin Routes (Authentication & Management)
Route::get('/admin/login', [AdminController::class, 'showLogin']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::match(['get', 'post'], '/admin/logout', [AdminController::class, 'logout']);

Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/participants', [AdminController::class, 'participants']);

// Management Ujian (Daftar Ujian, Tambah, Edit, Hapus & Monitoring Hasil)
Route::get('/admin/exams', [AdminController::class, 'exams']);
Route::get('/admin/exams/create', [AdminController::class, 'createExam']);
Route::post('/admin/exams', [AdminController::class, 'storeExam']);
Route::get('/admin/exams/{id}/edit', [AdminController::class, 'editExam']);
Route::post('/admin/exams/{id}', [AdminController::class, 'updateExam']);
Route::delete('/admin/exams/{id}', [AdminController::class, 'destroyExam']);
Route::get('/admin/exams/{id}/results', [AdminController::class, 'examResults']);

// Alias / Compatibility routes
Route::get('/admin/questions', [AdminController::class, 'questions']);
Route::get('/admin/results', [AdminController::class, 'results']);
Route::get('/admin/settings', [AdminController::class, 'settings']);
Route::post('/admin/settings', [AdminController::class, 'updateSettings']);
