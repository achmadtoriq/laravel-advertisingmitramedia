<?php

namespace App\Providers;

use App\Models\PublicPageSeo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('template.layout', function ($view) {
            try {
                $pageSeo = Schema::hasTable('public_page_seos') ? PublicPageSeo::forCurrentPath() : null;
            } catch (Throwable) {
                $pageSeo = null;
            }

            $view->with('pageSeo', $pageSeo);
        });
    }
}
