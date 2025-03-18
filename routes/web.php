<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalliperController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/data',[CalliperController::class,'calliperData'])->name('calliper.data');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
