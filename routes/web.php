<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicPageSeoController;
use App\Models\Article;
use App\Models\PublicPageSeo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/* Dashboard */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/conversion-events', [ConversionEventController::class, 'store'])
    ->middleware('throttle:60,1')
    ->name('conversion-events.store');
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/article', ArticleController::class);
    Route::post('/article/upload-image', [ArticleController::class, 'upload_image_article']);

    Route::resource('/projects', ProjectController::class);
    Route::get('/seo', [PublicPageSeoController::class, 'index']);
    Route::get('/seo/create', [PublicPageSeoController::class, 'create']);
    Route::post('/seo', [PublicPageSeoController::class, 'store']);
    Route::get('/seo/{seo}/edit', [PublicPageSeoController::class, 'edit']);
    Route::put('/seo/{seo}', [PublicPageSeoController::class, 'update']);
    Route::delete('/seo/{seo}', [PublicPageSeoController::class, 'destroy']);
    Route::get('/settings', [DashboardController::class, 'setting_menu']);

});

Route::get('/sitemap.xml', function () {

    try {
        $pages = Schema::hasTable('public_page_seos')
            ? PublicPageSeo::query()
                ->where('is_active', true)
                ->where('path', 'not like', '%*%')
                ->get()
                ->map(fn ($page) => [
                    'loc' => url($page->path),
                    'lastmod' => $page->updated_at->toAtomString(),
                ])
            : collect(PublicPageSeo::DEFAULT_PAGES)
                ->reject(fn ($page) => str_contains($page['path'], '*'))
                ->map(fn ($page) => [
                    'loc' => url($page['path']),
                    'lastmod' => now()->toAtomString(),
                ]);
    } catch (Throwable) {
        $pages = collect(PublicPageSeo::DEFAULT_PAGES)
            ->reject(fn ($page) => str_contains($page['path'], '*'))
            ->map(fn ($page) => [
                'loc' => url($page['path']),
                'lastmod' => now()->toAtomString(),
            ]);
    }

    $articles = Article::get()->map(function ($article) {
        return [
            'loc' => url('/artikel/'.$article->slug),
            'lastmod' => $article->updated_at->toAtomString(),
        ];
    });

    $urls = $pages->merge($articles);

    return response()->view('template.sitemap', [
        'urls' => $urls,
    ])->header('Content-Type', 'text/xml');
});

/* Dynamic public pages */
Route::get('/{path?}', [Main::class, 'show'])
    ->where('path', '.*')
    ->name('public.page');
