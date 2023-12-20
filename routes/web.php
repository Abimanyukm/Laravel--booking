<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;
 
Route::get('/', [BookingController::class, 'index'])->name('index');

Route::post('create-slot',[BookingController::class, 'create'])->name('create');
