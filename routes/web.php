<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get("/", function () {
    return Inertia::render("Dashboard");
})->name("dashboard");


Route::post("/login", [LoginController::class, "login"])->name("login")
    ->middleware("guest");


Route::post("/register", [RegisterController::class, "create"])
    ->name("register");

Route::post("/logout", [LoginController::class, "logout"])->name("logout");

