<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ConversionEvent;
use App\Models\PublicPageSeo;
use App\Services\GoogleAnalyticsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(GoogleAnalyticsService $ga)
    {
        $chart = collect($ga->getVisitorsChart(7))->sortBy('date')->values();
        $realtime = (int) $ga->getRealtimeUsers();
        $today = (int) $ga->getTodayVisitors();
        $yesterday = (int) $ga->getYesterdayVisitors();
        $topContent = $ga->getTopContent();
        $searchQueries = $ga->getSearchQueries();
        $searchLandingPages = $ga->getSearchLandingPages();
        $seoIssues = $this->seoIssues();
        $conversions = $this->conversions();

        $labels = collect($chart)->map(function ($item) {
            return Carbon::createFromFormat('Ymd', $item['date'])->format('d M');
        });

        $data = collect($chart)->pluck('users');
        $last7Days = (int) collect($chart)->sum('users');

        return view('admin.dashboard', [
            'gaEnabled' => $ga->isEnabled(),
            'gaMessages' => $ga->statusMessages(),
            'searchConsoleMessages' => $ga->searchConsoleStatusMessages(),
            'searchQueries' => $searchQueries,
            'searchLandingPages' => $searchLandingPages,
            'seoIssues' => $seoIssues,
            'conversions' => $conversions,
            'topContent' => $topContent,
            'realtime' => $realtime,
            'today' => $today,
            'yesterday' => $yesterday,
            'last7Days' => $last7Days,
            'dailyChange' => $today - $yesterday,
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function produk_menu()
    {
        return view('admin.produk-menu');
    }

    public function setting_menu()
    {
        return view('admin.setting-menu');
    }

    private function seoIssues(): array
    {
        $issues = [];

        if (Schema::hasTable('public_page_seos')) {
            $activePages = PublicPageSeo::query()->where('is_active', true);

            $issues[] = [
                'label' => 'Halaman aktif tanpa meta title',
                'count' => (clone $activePages)->where(fn ($query) => $query->whereNull('meta_title')->orWhere('meta_title', ''))->count(),
                'level' => 'danger',
                'url' => '/admin/seo',
            ];
            $issues[] = [
                'label' => 'Halaman aktif tanpa meta description',
                'count' => (clone $activePages)->where(fn ($query) => $query->whereNull('meta_description')->orWhere('meta_description', ''))->count(),
                'level' => 'danger',
                'url' => '/admin/seo',
            ];
            $issues[] = [
                'label' => 'Halaman aktif dengan robots noindex',
                'count' => (clone $activePages)->where('robots', 'like', '%noindex%')->count(),
                'level' => 'warning',
                'url' => '/admin/seo',
            ];
        }

        if (Schema::hasTable('articles_data')) {
            $issues[] = [
                'label' => 'Artikel tanpa SEO title',
                'count' => Article::query()->where(fn ($query) => $query->whereNull('seo_title')->orWhere('seo_title', ''))->count(),
                'level' => 'warning',
                'url' => '/admin/article',
            ];
            $issues[] = [
                'label' => 'Artikel tanpa SEO description',
                'count' => Article::query()->where(fn ($query) => $query->whereNull('seo_description')->orWhere('seo_description', ''))->count(),
                'level' => 'warning',
                'url' => '/admin/article',
            ];
        }

        return $issues;
    }

    private function conversions(): array
    {
        $from = now()->subDays(27)->startOfDay();

        return [
            'whatsapp' => Schema::hasTable('conversion_events')
                ? ConversionEvent::query()->where('event_type', 'whatsapp')->where('created_at', '>=', $from)->count()
                : 0,
            'phone' => Schema::hasTable('conversion_events')
                ? ConversionEvent::query()->where('event_type', 'phone')->where('created_at', '>=', $from)->count()
                : 0,
            'article_views' => Schema::hasTable('articles_data')
                ? (int) Article::query()->sum('views')
                : 0,
        ];
    }
}
