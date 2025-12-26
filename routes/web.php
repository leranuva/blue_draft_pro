<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/proposal', [HomeController::class, 'proposal'])->name('proposal');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
