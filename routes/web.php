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
Route::get('/artikel', [Main::class, "artikel"]);
Route::get('/artikel/{slug}', [Main::class, "artikelDetail"])->name('artikel.detail');
Route::get('/project', [Main::class, "project"]);
Route::get('/contact-us', [Main::class, "contact"]);

Route::get('/sitemap.xml', function () {

    $pages = [
        url('/'),
        url('/about-us'),
        url('/project'),
        url('/contact-us')
    ];

    return response()->view('template.sitemap', compact('pages'))
        ->header('Content-Type', 'text/xml');
});
