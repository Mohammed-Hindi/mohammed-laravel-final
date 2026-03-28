<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;


Route::get("login", [AuthController::class, "login"])->name("login");
Route::post("login", [AuthController::class, "authenticate"])->name("authenticate");
Route::post("logout", [AuthController::class, "logout"])->name("logout");

Route::middleware('auth')->group(function () {

    Route::get('dashboard', function () {
        return view('layouts.app');
    })->name('dashboard');

    Route::resource('books', BookController::class);
});
