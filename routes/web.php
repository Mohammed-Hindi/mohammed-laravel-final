<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::resource('books', BookController::class);
Route::get("dashboard", function () {
    return view("layouts.app");
})->name("dashboard");

Route::get("login", [AuthController::class, "login"])->name("login");
Route::post("login", [AuthController::class, "authenticate"])->name("authenticate");
Route::post("logout", [AuthController::class, "logout"])->name("logout");