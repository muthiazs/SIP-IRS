<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view("/", "welcome");

Route::get("/login", [AuthController::class, "login"]);
Route::post("/login", [AuthController::class, "loginPost"])
    ->name("login.post");
Route::get('/register', [AuthController::class, 'register']);
Route::post("/register", [AuthController::class, "registerPost"])
    ->name("register.post");