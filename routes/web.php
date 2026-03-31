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
    Route::get('/settings', [DashboardController::class, "setting_menu"]);

});

/* Landing */
Route::get('/', [Main::class, "index"]);
Route::get('/about-us', [Main::class, "about"]);
Route::get('/artikel', [Main::class, "artikel"]);
Route::get('/artikel/{slug}', [Main::class, "artikelDetail"])->name('artikel.detail');
Route::get('/project', [Main::class, "project"]);
Route::get('/contact-us', [Main::class, "contact"]);

Route::get('/sitemap.xml', function () {

    $pages = collect([
        ['loc' => url('/'), 'lastmod' => now()->toAtomString()],
        ['loc' => url('/about-us'), 'lastmod' => now()->toAtomString()],
        ['loc' => url('/artikel'), 'lastmod' => now()->toAtomString()],
        ['loc' => url('/project'), 'lastmod' => now()->toAtomString()],
        ['loc' => url('/contact-us'), 'lastmod' => now()->toAtomString()],
    ]);

    $articles = Article::get()->map(function ($article) {
        return [
            'loc' => url('/artikel/' . $article->slug),
            'lastmod' => $article->updated_at->toAtomString()
        ];
    });

    $urls = $pages->merge($articles);

    return response()->view('template.sitemap', [
        'urls' => $urls
    ])->header('Content-Type', 'text/xml');
});
