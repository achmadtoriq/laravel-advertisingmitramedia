<?php

use App\Http\Controllers\Main;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::prefix('agen-pulsa')->group(function () {
//     Route::get('/', [HomeController::class, "index"]);
//     Route::get('/{provider}', [HomeController::class, "index"]);
// });


Route::get('/', [Main::class, "index"]);
Route::get('/about-us', [Main::class, "about"]);
Route::get('/project', [Main::class, "project"]);
Route::get('/contact-us', [Main::class, "contact"]);