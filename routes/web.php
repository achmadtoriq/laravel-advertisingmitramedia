<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main;
use App\Http\Controllers\ProjectController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

/* Dashboard */
Route::get('/login', [AuthController::class, "index"])->name('login');
Route::post('/login',[AuthController::class,'authenticate']);
Route::post('/logout', [AuthController::class,'logout']);
Route::middleware('auth')->prefix('admin')->group(function(){

    Route::get('/dashboard', [DashboardController::class, "index"]);
    Route::resource('/article', ArticleController::class);
    Route::post('/article/upload-image', [ArticleController::class,'upload_image_article']);

    Route::resource('/projects', ProjectController::class);
    Route::get('/setting', [DashboardController::class, "setting_menu"]);

});

/* Landing */
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
        url('/artikel'),
        url('/project'),
        url('/contact-us')
    ];

    $articles = Article::pluck('slug')->map(function ($slug) {
        return url('/artikel/' . $slug);
    });

    $urls = collect($pages)->merge($articles);

    return response()->view('template.sitemap',  [
        'urls' => $urls
    ])->header('Content-Type', 'text/xml');
});
