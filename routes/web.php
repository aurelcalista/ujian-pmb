<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - UCIC CBT PMB UI/UX Prototype
|--------------------------------------------------------------------------
*/

// Master Interactive Demo Portal
Route::get('/', function () {
    return view('index');
});

// Student Pages (No Login / Registration Required)
Route::get('/student/landing', function () {
    return view('student.landing');
});

Route::get('/student/form', function () {
    return view('student.participant-form');
});

Route::get('/student/info', function () {
    return view('student.exam-info');
});

Route::get('/student/exam', function () {
    return view('student.exam-page');
});

Route::get('/student/thank-you', function () {
    return view('student.thank-you');
});

// Admin Pages (Authenticated Administrator Dashboard)
Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/participants', function () {
    return view('admin.participants');
});

Route::get('/admin/questions', function () {
    return view('admin.questions');
});

Route::get('/admin/results', function () {
    return view('admin.results');
});

Route::get('/admin/settings', function () {
    return view('admin.settings');
});
